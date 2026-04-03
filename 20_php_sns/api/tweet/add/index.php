<?php
require_once '../../../app.php';

use App\Models\AuthUser;
use App\Models\Tweet;
use App\Models\User;

ob_start();
header('Content-Type: application/json');

function respondJson(int $status, array $payload): void
{
    $buffer = ob_get_clean();
    if ($buffer !== '' && $buffer !== false) {
        error_log('api/tweet/add unexpected output: ' . trim($buffer));
    }

    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

try {
    // 認証チェック
    $auth_user = AuthUser::get();
    if (!$auth_user) {
        respondJson(401, ['error' => 'Unauthorized']);
    }

    // POST のみ受け付け
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        respondJson(405, ['error' => 'Method Not Allowed']);
    }

    $message = trim($_POST['message'] ?? '');
    if ($message === '') {
        respondJson(400, ['error' => 'メッセージを入力してください']);
    }

    // Tweetモデルのinsertメソッドを呼び出して投稿する
    $tweet = new Tweet();
    $tweet_id = $tweet->insert($auth_user['id'], ['message' => $message]);

    // 投稿に失敗した場合
    if (!$tweet_id) {
        respondJson(500, ['error' => '投稿に失敗しました']);
    }

    // 投稿データを取得
    $data = $tweet->findWithUser((int) $tweet_id);
    if (!$data) {
        respondJson(500, ['error' => '投稿データの取得に失敗しました']);
    }

    $data['like_count'] = 0;
    $data['liked'] = false;

    // プロフィール画像のURLを取得
    $data['profile_image_url'] = User::profileImage($data['profile_image']);
    if (empty($data['image_path'])) {
        $data['image_path'] = null;
    }

    // 成功レスポンス
    respondJson(200, $data);
} catch (\Throwable $e) {
    error_log('api/tweet/add failed: ' . $e->getMessage());
    respondJson(500, ['error' => '投稿に失敗しました']);
}

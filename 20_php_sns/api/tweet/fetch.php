<?php
require_once '../../app.php';

use App\Models\AuthUser;
use App\Models\Tweet;
use App\Models\User;

// JSONヘッダー
header('Content-Type: application/json');

// 認証チェック
$auth_user = AuthUser::get();
if (!$auth_user) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized'], JSON_UNESCAPED_UNICODE);
    exit;
}

// IDチェック
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Tweetモデル
$tweet = new Tweet();
// ツイートデータ
$data  = $tweet->findWithUser($id, (int) $auth_user['id']);
if (!$data) {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Userモデル
// プロフィール画像URL
$data['profile_image_url'] = User::profileImage($data['profile_image']);
$data['like_count'] = (int) ($data['like_count'] ?? 0);
$data['reply_count'] = (int) ($data['reply_count'] ?? 0);
$data['liked'] = (bool) ($data['liked'] ?? false);
// 画像パス
if (empty($data['image_path'])) {
    $data['image_path'] = null;
}
// JSON返却
echo json_encode($data, JSON_UNESCAPED_UNICODE);

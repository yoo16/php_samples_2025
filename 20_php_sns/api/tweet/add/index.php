<?php
require_once '../../../app.php';

use App\Models\AuthUser;
use App\Models\Tweet;
use App\Models\User;

header('Content-Type: application/json');

// 認証チェック
$auth_user = AuthUser::get();
if (!$auth_user) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized'], JSON_UNESCAPED_UNICODE);
    exit;
}

// POST のみ受け付け
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

$message = trim($_POST['message'] ?? '');
if ($message === '') {
    http_response_code(400);
    echo json_encode(['error' => 'メッセージを入力してください'], JSON_UNESCAPED_UNICODE);
    exit;
}

$tweet = new Tweet();
$tweet_id = $tweet->insert($auth_user['id'], ['message' => $message]);

if (!$tweet_id) {
    http_response_code(500);
    echo json_encode(['error' => '投稿に失敗しました'], JSON_UNESCAPED_UNICODE);
    exit;
}

$data = $tweet->findWithUser((int) $tweet_id);
$data['like_count']        = 0;
$data['liked']             = false;
$data['profile_image_url'] = User::profileImage($data['profile_image']);
if (empty($data['image_path'])) {
    $data['image_path'] = null;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

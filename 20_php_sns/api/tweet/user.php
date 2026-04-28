<?php
require_once '../../app.php';

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

$user_id = isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request'], JSON_UNESCAPED_UNICODE);
    exit;
}

$tweet  = new Tweet();
$tweets = $tweet->getByUserID($user_id, (int) $auth_user['id']);

if ($tweets) {
    foreach ($tweets as &$t) {
        $t['profile_image_url'] = User::profileImage($t['profile_image']);
        $t['liked']             = (bool) ($t['liked'] ?? false);
        if (empty($t['image_path'])) {
            $t['image_path'] = null;
        }
    }
    unset($t);
}

echo json_encode($tweets ?? [], JSON_UNESCAPED_UNICODE);

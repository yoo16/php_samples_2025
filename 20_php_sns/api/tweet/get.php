<?php
require_once '../../app.php';

use App\Models\AuthUser;
use App\Services\TweetService;

header('Content-Type: application/json');

// 認証チェック
$auth_user = AuthUser::get();
if (!$auth_user) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized'], JSON_UNESCAPED_UNICODE);
    exit;
}

// ページネーションパラメータ
$limit  = isset($_GET['limit'])  ? (int) $_GET['limit']  : 10;
$offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;
$tab = $_GET['tab'] ?? 'public';

if (!in_array($tab, ['public', 'followers'], true)) {
    $tab = 'public';
}

$tweetService = new TweetService();
$tweets = $tweetService->getTimelineTweets((int) $auth_user['id'], $tab, $limit, $offset);

echo json_encode($tweets ?? [], JSON_UNESCAPED_UNICODE);

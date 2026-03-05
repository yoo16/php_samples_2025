<?php
require_once '../../app.php';

use App\Models\Like;
use App\Models\AuthUser;
use Lib\Request;

// POSTリクエスト以外は処理しない
Request::isPost();

// ログインユーザチェック
$auth_user = AuthUser::checkLogin();

$tweet_id = $_POST['tweet_id'] ?? null;
$user_id = $_POST['user_id'] ?? null;

if ($tweet_id && $user_id) {
    // tweet_id と user_id があれば、いいねの更新
    $like = new Like();
    $like->update($tweet_id, $user_id);
}

// 前の画面にリダイレクト
header('Location: ../');

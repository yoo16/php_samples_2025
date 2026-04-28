<?php
require_once '../app.php';

use App\Models\AuthUser;
use App\Models\User;
use Lib\Csrf;

// 認証チェック
AuthUser::checkLogin();
$auth_user = AuthUser::get();

if (!Csrf::verify()) {
    $_SESSION[APP_KEY]['user_edit'] = [
        'error' => '不正なリクエストです。',
    ];
    header('Location: edit.php');
    exit;
}

$user = new User();
// 画像アップロード
$result = $user->uploadProfileImage($auth_user['id']);

if (!$result) {
    $_SESSION[APP_KEY]['user_edit'] = [
        'error' => '画像の更新に失敗しました。',
    ];
    header('Location: edit.php');
    exit;
}

// ユーザ情報をセッションに保存
$_SESSION[APP_KEY]['auth_user'] = $user->find($auth_user['id']);
$_SESSION[APP_KEY]['user_edit'] = [
    'success' => '画像を更新しました。',
];
// 編集画面にリダイレクト
header('Location: edit.php');

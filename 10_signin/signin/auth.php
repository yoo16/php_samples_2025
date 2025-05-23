<?php
// 共通ファイル app.php を読み込み
require_once '../app.php';

// POSTリクエストでなければ何も表示しない
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit;
}

// TODO: セッションにPOSTデータを登録
$_SESSION['signin'] = $_POST;

// TODO: 入力されたアカウント名とパスワードを取得
$email = $_POST['email'];
$password = $_POST['password'];

// TODO: ユーザ認証: new User() で auth() を実行
$user = new User();
$auth_user = $user->auth($email, $password);

if (empty($auth_user['id'])) {
    // エラーセッション
    $_SESSION['error'] = 'メールアドレスまたはパスワードが間違っています。';
    // ログイン失敗時はログイン入力画面にリダイレクト
    header('Location: input.php');
    exit;
} else {
    // TODO: 認証成功時はセッションにユーザデータを保存
    AuthUser::set($auth_user);

    // TODO: トップページにリダイレクト
    header('Location: ../home/');
    exit;
}
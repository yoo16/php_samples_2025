<?php

/**
 * 07_form_session/post_receive.php
 * POSTデータを受け取り、認証検証を行ってからリダイレクトする
 */

// セッションの開始
session_start();

// テストユーザー情報 (本来はデータベース等で管理します)
const TEST_USER = [
    'name' => '東京 太郎',
    'email' => 'user@example.com',
    'password' => 'password123'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // 入力データの保持 (復元用)
    $_SESSION['previous_post'] = $_POST;

    // 認証検証
    if ($email === TEST_USER['email'] && $password === TEST_USER['password']) {
        // 認証成功
        $_SESSION['status'] = 'success';
        $_SESSION['authUser'] = TEST_USER;
        $_SESSION['message'] = 'ログインに成功しました。';

        // 成功時はパスワードを保持しない（セキュリティの基本）
        unset($_SESSION['previous_post']['password']);
    } else {
        // 認証失敗
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = 'メールアドレスまたはパスワードが正しくありません。';
    }
}

// 元のページへリダイレクト (PRGパターン)
header('Location: post_request.php');
exit;

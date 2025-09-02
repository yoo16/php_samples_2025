<?php
session_start();
require './Contact.php';

$contact = new Contact();

$name  = $_POST['name']  ?? '';
$email = $_POST['email'] ?? '';
$body  = $_POST['body']  ?? '';

// バリデーション
// $error = $contact->validate($name, $email, $body);
// if ($error) {
//     $_SESSION['error'] = $error;
//     header("Location: contact.php");
//     exit;
// }

// メール送信
$result = $contact->send($name, $email, $body);
// if ($result === true) {
//     $_SESSION['success'] = "お問い合わせを送信しました。";
// } else {
//     $_SESSION['error'] = "送信に失敗しました: {$result}";
// }

header("Location: result.php");
exit;
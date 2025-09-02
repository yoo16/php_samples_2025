<?php
session_start();

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// .env 読み込み
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// POST データ受け取り
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$body    = $_POST['body'] ?? '';

// バリデーション
$error = validateInput($name, $email, $subject, $body);
if ($error) {
    $_SESSION['error'] = $error;
    header("Location: contact.php");
    exit;
}

// メール送信
$result = sendMail($name, $email, $subject, $body);
if ($result === true) {
    $_SESSION['success'] = "お問い合わせを送信しました。";
} else {
    $_SESSION['error'] = "送信に失敗しました: {$result}";
}

header("Location: contact.php");
exit;

/**
 * テンプレートを読み込んで置換
 */
function loadTemplate($filePath, $vars = [])
{
    $template = file_get_contents($filePath);
    foreach ($vars as $key => $value) {
        $template = str_replace("{{{$key}}}", $value, $template);
    }
    return $template;
}

/**
 * 入力バリデーション
 */
function validateInput($name, $email, $subject, $body)
{
    if (empty($name) || empty($email) || empty($subject) || empty($body)) {
        return "すべてのフィールドを入力してください。";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "有効なメールアドレスを入力してください。";
    }
    return '';
}

/**
 * メール送信処理
 */
function sendMail($name, $email, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port       = (int) $_ENV['MAIL_PORT'];
        $mail->CharSet    = 'UTF-8';
        $mail->Encoding   = 'base64';

        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        $mail->addAddress($_ENV['MAIL_TO_ADDRESS']); // 管理者宛
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);

        $mail->Subject = "[お問い合わせ] " . $subject;
        $mail->Body    = loadTemplate(__DIR__ . "/templates/contact_mail.html", [
            "name"    => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            "email"   => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            "subject" => htmlspecialchars($subject, ENT_QUOTES, 'UTF-8'),
            "body"    => nl2br(htmlspecialchars($body, ENT_QUOTES, 'UTF-8'))
        ]);

        return $mail->send();
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}
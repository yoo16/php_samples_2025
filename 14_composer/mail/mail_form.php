<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// .env 読み込み
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // メール送信
    $is_sended = sendMail($to, $subject, $body);
    $message = $is_sended === true ? 'メールを送信しました' : 'メール送信に失敗しました';
}

/**
 * メール送信関数
 */
function sendMail($to, $subject, $body)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $mail->Port = (int) $_ENV['MAIL_PORT'];
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // 送信元アドレスと名前を設定
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
        // 宛先アドレスを設定
        $mail->addAddress($to);
        $mail->isHTML(true);
        // 件名
        $mail->Subject = $subject;
        // 本文
        $mail->Body = $body;
        // HTML以外の本文
        $mail->AltBody = strip_tags($body);
        // メール送信
        return $mail->send();
    } catch (Exception $e) {
        return $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>メール送信フォーム</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8 text-gray-800">
    <!-- 全画面スピナーモーダル -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="flex flex-col items-center">
            <svg class="animate-spin h-10 w-10 text-white mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <p class="text-white text-lg font-semibold">送信中...</p>
        </div>
    </div>

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">メール送信フォーム</h1>

        <!-- メッセージ -->
        <?php if ($message): ?>
            <div class="mb-4 p-3 rounded <?= $is_sended ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- メール送信フォーム -->
        <form method="POST" class="space-y-4" onsubmit="handleSubmit(event)">
            <div>
                <label class="block font-semibold mb-1">宛先メールアドレス</label>
                <input type="email" name="to" required class="w-full border px-4 py-2 rounded" value="<?= htmlspecialchars($_POST['to'] ?? '') ?>">
            </div>
            <div>
                <label class="block font-semibold mb-1">件名</label>
                <input type="text" name="subject" required class="w-full border px-4 py-2 rounded" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
            </div>
            <div>
                <label class="block font-semibold mb-1">本文</label>
                <textarea name="body" rows="6" required class="w-full border px-4 py-2 rounded"><?= htmlspecialchars($_POST['body'] ?? '') ?></textarea>
            </div>
            <div class="flex justify-center">
                <button id="submitBtn" type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center gap-2">
                    <span id="btnText">メール送信</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        // メール送信中はスピナー表示
        function handleSubmit(event) {
            document.getElementById("loadingOverlay").classList.remove("hidden");
        }
    </script>
</body>

</html>
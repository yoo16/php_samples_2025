<?php
require './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class Contact
{
    private $mailer;
    private $template = __DIR__ . "/templates/contact_mail.html";

    public function __construct()
    {
        // .env 読み込み
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->mailer = new PHPMailer(true);
        $this->setupMailer();
    }

    /**
     * メーラー初期設定
     */
    private function setupMailer(): void
    {
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Host       = $_ENV['MAIL_HOST'];
        $this->mailer->Username   = $_ENV['MAIL_USERNAME'];
        $this->mailer->Password   = $_ENV['MAIL_PASSWORD'];
        $this->mailer->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
        $this->mailer->Port       = (int) $_ENV['MAIL_PORT'];
        $this->mailer->CharSet    = 'UTF-8';
        $this->mailer->Encoding   = 'base64';
    }

    /**
     * 入力バリデーション
     */
    public function validate(string $name, string $email, string $body)
    {
        if (empty($name) || empty($email) || empty($body)) {
            return "すべてのフィールドを入力してください。";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "有効なメールアドレスを入力してください。";
        }
        return '';
    }

    /**
     * テンプレートを読み込んで置換
     */
    private function loadTemplate(array $vars = [])
    {
        $template = file_get_contents($this->template);
        foreach ($vars as $key => $value) {
            $template = str_replace("{{{$key}}}", $value, $template);
        }
        return $template;
    }

    /**
     * メール送信
     */
    public function send(string $name, string $email, string $body)
    {
        try {
            $this->mailer->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
            $this->mailer->addAddress($email, $name);
            $this->mailer->addReplyTo($_ENV['MAIL_FROM_ADDRESS'], $_ENV['MAIL_FROM_NAME']);
            $this->mailer->isHTML(true);

            $this->mailer->Subject = "[お問い合わせ]ご確認のメール";
            $this->mailer->Body = $this->loadTemplate([
                "name"  => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                "email" => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
                "body"  => nl2br(htmlspecialchars($body, ENT_QUOTES, 'UTF-8'))
            ]);

            return $this->mailer->send();
        } catch (Exception $e) {
            return $this->mailer->ErrorInfo;
        }
    }
}
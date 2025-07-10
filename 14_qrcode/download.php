<?php
// 保存されたQRコードのファイル名（例: qr_xxx.png）
$filename = $_GET['file'] ?? '';

// セキュリティチェック（任意のファイルを指定されないよう制限）
if (!preg_match('/^qr_[a-f0-9]{32}\.png$/', $filename)) {
    http_response_code(400);
    echo "不正なファイル名です。";
    exit;
}

$filepath = __DIR__ . '/tmp/' . $filename;

if (!file_exists($filepath)) {
    http_response_code(404);
    echo "ファイルが見つかりません。";
    exit;
}

// ダウンロード用のHTTPヘッダーを設定
header('Content-Description: File Transfer');
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filepath));
header('Cache-Control: must-revalidate');
header('Pragma: public');
readfile($filepath);
exit;

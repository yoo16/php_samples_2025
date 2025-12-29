<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Generator.php';

// 設定ファイルの読み込み
$config = require __DIR__ . '/config/pdf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gen = new App\Generator($config);
    $gen->generate($_POST);
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>名刺ジェネレーター</title>
    <link rel="stylesheet" href="css/editor.css?<?= time() ?>">
    <link rel="stylesheet" href="css/pdf.css?<?= time() ?>">
</head>

<body>

    <aside class="editor-sidebar">
        <div class="editor-header">
            <h2>デザイン編集</h2>
        </div>
        <form method="POST" class="editor-form" enctype="multipart/form-data">
            <div class="input-group">
                <label>氏名</label>
                <input type="text" name="name" id="in_name" value="東京 太郎" oninput="update()">
            </div>
            <div class="input-group">
                <label>役職</label>
                <input type="text" name="title" id="in_title" value="SENIOR ENGINEER" oninput="update()">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" id="in_email" value="tokyo@example.com" oninput="update()">
            </div>
            <div class="input-group">
                <label>Web</label>
                <input type="text" name="web" id="in_web" value="https://tokyo.com" oninput="update()">
            </div>
            <div class="input-group">
                <label>Tel</label>
                <input type="text" name="tel" id="in_tel" value="090-0000-0000" oninput="update()">
            </div>
            <div class="input-group">
                <label>背景画像</label>
                <input type="file" name="bg_image" id="in_bg" accept="image/*" onchange="previewImage(this)">
            </div>
            <input type="hidden" name="bg_base64" id="bg_base64">

            <button type="submit" class="btn-download">PDFをダウンロード</button>
        </form>
    </aside>

    <main class="preview-main">
        <div class="preview-header">
            <h2>Live Preview</h2>
        </div>
        <div class="preview-canvas">
            <?php
            $name = $title = $email = $web = $tel = "";
            include 'templates/card.php';
            ?>
        </div>
    </main>

    <script src="js/app.js"></script>
</body>

</html>
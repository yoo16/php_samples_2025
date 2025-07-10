<?php
require '../vendor/autoload.php';

// Markdownファイルのパス
$file = './data/sample.md';

// ファイルの読み込みとMarkdown変換
if (file_exists($file)) {
    $markdown = file_get_contents($file);
    $parsedown = new Parsedown();
    $html = $parsedown->text($markdown);
} else {
    $html = '<p>Markdownファイルが見つかりません。</p>';
}

?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Markdown Viewer</title>
    <style>
        body { font-family: sans-serif; padding: 2em; max-width: 800px; margin: auto; }
        pre { background: #f4f4f4; padding: 1em; overflow-x: auto; }
        code { font-family: monospace; }
    </style>
</head>
<body>
    <div><?= $html ?></div>
</body>
</html>
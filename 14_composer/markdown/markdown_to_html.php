<?php
require '../vendor/autoload.php';

$file = './data/blog.md';

$markdown = '';
$html = '';

if (file_exists($file)) {
    $markdown = file_get_contents($file);
    $parsedown = new Parsedown();
    $html = $parsedown->text($markdown);
    $markdown = htmlspecialchars($markdown, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Markdown Viewer</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<body>
    <main class="container">

        <h1>Markdown Viewer</h1>

        <div class="columns">
            <!-- Markdownの生表示 -->
            <div class="column">
                <h2>Markdown</h2>
                <div class="box">
                    <pre><?= $markdown ?></pre>
                </div>
            </div>

            <!-- HTMLとして表示されたMarkdown -->
            <div class="column">
                <h2>HTML</h2>
                <div class="box">
                    <div class="prose">
                        <?= $html ?>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

</html>
<?php
// Parsedown の読み込み（パスは環境に合わせて調整してください）
require_once __DIR__ . '/vendor/erusev/parsedown/Parsedown.php';

// URLパラメータの取得とサニタイズ
$n = preg_replace('/[^0-9_-]/', '', $_GET['n'] ?? '');

if (!$n) {
    http_response_code(400);
    exit('番号を指定してください。');
}

$mdFile = __DIR__ . '/explains/' . $n . '.md';

if (!file_exists($mdFile)) {
    http_response_code(404);
    exit('ファイルが見つかりません。');
}

$markdown = file_get_contents($mdFile);

// Parsedown で一括変換
$parsedown = new Parsedown();
$parsedown->setSafeMode(false); // HTMLタグを許可する場合
$content = $parsedown->text($markdown);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson <?= htmlspecialchars($n) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/prism.css">
    <link rel="stylesheet" href="css/explain.css">
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="font-bold text-slate-700">PHP Study</span>
            <a href="index.php" class="text-sm text-indigo-600 hover:underline">&larr; 戻る</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12 bg-white my-8 shadow-sm rounded-xl">
        <article class="prose">
            <?= $content ?>
        </article>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
</body>

</html>
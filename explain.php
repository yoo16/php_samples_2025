<?php
// URLパラメータ ?n=04 などで番号を受け取る
$n = preg_replace('/[^0-9]/', '', $_GET['n'] ?? '');

if (!$n) {
    http_response_code(400);
    exit('番号を指定してください。例: explain.php?n=04');
}

$mdFile = __DIR__ . '/explains/' . sprintf('%02d', (int)$n) . '.md';

if (!file_exists($mdFile)) {
    http_response_code(404);
    exit('ファイルが見つかりません: explains/' . htmlspecialchars($n, ENT_QUOTES) . '.md');
}

$markdown = file_get_contents($mdFile);

// 最初の ## 見出しをタイトルとして抽出
preg_match('/^##\s+(.+)$/m', $markdown, $titleMatch);
$title = isset($titleMatch[1]) ? trim($titleMatch[1]) : 'Lesson ' . $n;

// 最初の見出し直後の段落を description として抽出
preg_match('/^##\s+.+\n\n(.+?)(?:\n|$)/m', $markdown, $descMatch);
$description = isset($descMatch[1]) ? trim($descMatch[1]) : '';

$lesson_number = sprintf('%02d', (int)$n);

// Parsedown でマークダウンを HTML に変換
require_once __DIR__ . '/20_composer/vendor/erusev/parsedown/Parsedown.php';
$parsedown = new Parsedown();
$parsedown->setSafeMode(false);
$content = $parsedown->text($markdown);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title, ENT_QUOTES) ?> | PHP Basics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js for code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Markdown prose styling */
        .prose h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 3rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .prose h2:first-child {
            margin-top: 0;
        }
        .prose h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
        }
        .prose p {
            margin-bottom: 1rem;
            color: #334155;
            line-height: 1.75;
        }
        .prose ul, .prose ol {
            margin-bottom: 1rem;
            padding-left: 1.5rem;
            color: #334155;
        }
        .prose ul { list-style-type: disc; }
        .prose ol { list-style-type: decimal; }
        .prose li {
            margin-bottom: 0.35rem;
            line-height: 1.7;
        }
        .prose blockquote {
            border-left: 4px solid #f59e0b;
            background: #fffbeb;
            color: #92400e;
            padding: 1rem 1.25rem;
            border-radius: 0 1rem 1rem 0;
            margin: 1.5rem 0;
            font-size: 0.9rem;
        }
        .prose blockquote p {
            color: inherit;
            margin-bottom: 0;
        }
        .prose pre {
            border-radius: 0.75rem;
            margin: 1.25rem 0;
            overflow-x: auto;
        }
        .prose pre[class*="language-"] {
            margin: 1.25rem 0;
        }
        .prose strong {
            font-weight: 700;
            color: #0f172a;
        }
        .prose img {
            max-width: 100%;
            border-radius: 0.75rem;
            margin: 1rem 0;
        }
        .prose hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 2rem 0;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <!-- Nav -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight text-slate-900"><?= htmlspecialchars($title, ENT_QUOTES) ?></h1>
            <a href="index.php" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition">&larr; ダッシュボード</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">

        <!-- Header -->
        <header class="mb-12">
            <div class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold uppercase tracking-wider mb-4">
                Lesson <?= $lesson_number ?>
            </div>
            <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">
                <?= htmlspecialchars($title, ENT_QUOTES) ?>
            </h2>
            <?php if ($description): ?>
                <p class="text-lg text-slate-600"><?= htmlspecialchars($description, ENT_QUOTES) ?></p>
            <?php endif; ?>
        </header>

        <!-- Markdown content -->
        <article class="prose">
            <?= $content ?>
        </article>

        <footer class="mt-16 pt-8 border-t border-slate-200 text-center">
            <a href="index.php" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                ダッシュボードに戻る
            </a>
        </footer>
    </main>

    <!-- Prism.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>
</body>

</html>

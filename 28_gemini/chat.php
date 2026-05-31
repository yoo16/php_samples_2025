<?php
require_once 'env.php';
require_once 'services/GeminiService.php';

$result = '';
// POSTリクエストが送信された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTリクエストからプロンプトを取得
    $prompt = $_POST['prompt'] ?? '';
    // Geminiクラスのインスタンスを作成
    $gemini = new GeminiService();
    // chat() を実行
    $result = $gemini->chat($prompt);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dompurify@3.2.5/dist/purify.min.js"></script>
    <style>
        .markdown-body {
            line-height: 1.75;
        }

        .markdown-body h1,
        .markdown-body h2,
        .markdown-body h3 {
            font-weight: 700;
            margin-top: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .markdown-body h1 {
            font-size: 1.5rem;
        }

        .markdown-body h2 {
            font-size: 1.25rem;
        }

        .markdown-body h3 {
            font-size: 1.125rem;
        }

        .markdown-body p,
        .markdown-body ul,
        .markdown-body ol,
        .markdown-body pre,
        .markdown-body blockquote {
            margin-top: 0.75rem;
        }

        .markdown-body ul,
        .markdown-body ol {
            padding-left: 1.5rem;
        }

        .markdown-body ul {
            list-style: disc;
        }

        .markdown-body ol {
            list-style: decimal;
        }

        .markdown-body code {
            background: #eef2ff;
            border-radius: 0.25rem;
            padding: 0.125rem 0.25rem;
            font-size: 0.95em;
        }

        .markdown-body pre {
            background: #111827;
            color: #f9fafb;
            overflow-x: auto;
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .markdown-body pre code {
            background: transparent;
            padding: 0;
        }

        .markdown-body blockquote {
            border-left: 4px solid #93c5fd;
            color: #4b5563;
            padding-left: 1rem;
        }

        .markdown-body a {
            color: #2563eb;
            text-decoration: underline;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-100 p-6">
    <main class="mx-auto max-w-4xl space-y-6">
        <header class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-sky-600">Gemini API</p>
                <h1 class="mt-1 text-2xl font-bold text-slate-900">Chat</h1>
            </div>
            <nav class="flex gap-3 text-sm font-semibold">
                <a href="index.php" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-700 hover:border-sky-300 hover:text-sky-700">メニュー</a>
                <a href="whats_photo.php" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-slate-700 hover:border-sky-300 hover:text-sky-700">What's Photo</a>
            </nav>
        </header>

        <section class="rounded-lg bg-white p-6 shadow">
            <div class="mb-5">
                <h2 class="text-lg font-semibold text-slate-900">質問を入力</h2>
                <p class="mt-1 text-sm text-slate-500">質問を送信すると、Gemini の Markdown 形式の回答を整形して表示します。</p>
            </div>

            <form action="" method="post" class="space-y-4" data-loading-message="Gemini に質問を送信しています。しばらくお待ちください。">
                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">質問内容</span>
                    <textarea name="prompt" rows="5" class="w-full rounded-lg border border-slate-300 bg-white p-3 leading-7 text-slate-700 outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-100" placeholder="質問を入力してください..."><?= htmlspecialchars($_POST['prompt'] ?? '') ?></textarea>
                </label>
                <div class="flex justify-end">
                    <button type="submit" class="rounded-lg bg-sky-600 px-5 py-2.5 font-semibold text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-200">送信</button>
                </div>
            </form>
        </section>

        <?php if ($result): ?>
            <section class="rounded-lg border border-slate-200 bg-white p-6 shadow">
                <h2 class="text-lg font-semibold text-slate-900">Geminiの回答</h2>
                <div id="gemini-response" class="markdown-body mt-5 rounded-lg border border-slate-200 bg-slate-50 p-5 text-slate-800"></div>
                <script id="gemini-result" type="application/json"><?= json_encode($result, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
            </section>
        <?php endif; ?>
    </main>

    <?php if ($result): ?>
        <script>
            const responseElement = document.getElementById('gemini-response');
            const markdownElement = document.getElementById('gemini-result');

            if (responseElement && markdownElement) {
                const markdownText = JSON.parse(markdownElement.textContent);

                if (window.marked && window.DOMPurify) {
                    marked.setOptions({
                        breaks: true,
                        gfm: true
                    });
                    responseElement.innerHTML = DOMPurify.sanitize(marked.parse(markdownText));
                } else {
                    responseElement.textContent = markdownText;
                    responseElement.classList.add('whitespace-pre-wrap');
                }
            }
        </script>
    <?php endif; ?>
    <?php include 'components/loading_modal.php'; ?>
</body>

</html>

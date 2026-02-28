<?php
$title = 'PHP基礎：はじめてのPHP';
$description = 'PHPプログラムを動かすために必要な、最も基本的で重要な記号の意味を学びましょう。';
$lesson_number = 1;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：PHPの基本 | PHP Basics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        </header>

        <!-- Section 1: Tags -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                開始タグと終了タグ
            </h3>
            <p class="mb-4">PHPのコードは、必ず <code>&lt;?php</code> で書き始めます。これが「ここからPHPが始まります」という合図になります。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-op">&lt;?php</span>
<span class="hl-keyword">echo</span> <span class="hl-string">"こんにちは！"</span>;
<span class="hl-comment">// PHPのみのファイルの場合、終了タグ ?&gt; は省略するのが一般的です</span></code></pre>
            </div>
            <p class="mb-4 text-sm">HTMLの中に埋め込む場合は、<code>?&gt;</code> で閉じることで「ここでPHPを終わります」と伝え、そこから先は普通のHTMLとして扱われます。
            </p>
        </section>

        <!-- Section 2: Variable prefix $ -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                変数の目印 <code>$</code>
            </h3>
            <p class="mb-4">PHPで「変数（データを入れる箱）」を扱うときは、必ず名前の前に <code>$</code> をつけます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$name</span> = <span class="hl-string">"太郎"</span>;
<span class="hl-keyword">echo</span> <span class="hl-var">$name</span>; <span class="hl-comment">// $を忘れるとエラーになります</span></code></pre>
            </div>
        </section>

        <!-- Section 3: Semicolon ; -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                文の終わり <code>;</code>
            </h3>
            <p class="mb-4">一つの命令が終わるごとに、必ず <code>;</code>
                （セミコロン）をつけます。日本語で言う「。」（句点）のような役割です。これを忘れると、PHPはどこまでが命令なのか分からず止まってしまいます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">echo</span> <span class="hl-string">"おはよう"</span><span class="hl-op">;</span>
<span class="hl-keyword">echo</span> <span class="hl-string">"おやすみ"</span><span class="hl-op">;</span></code></pre>
            </div>
        </section>

        <!-- Section 4: CLI Demo Explanation -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                CLIでの対話的な実行
            </h3>
            <p class="mb-4"><code>cli_demo.php</code> では、コマンドライン（黒い画面）特有の書き方を使っています。特に、キーボードからの入力を受け取る
                <code>STDIN</code> がポイントです。
            </p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 標準入力（キーボード）から1行読み込む</span>
<span class="hl-var">$input</span> = <span class="hl-num">fgets</span>(<span class="hl-num">STDIN</span>);

<span class="hl-comment">// OSごとの改行コードを表す定数（ターミナルでの改行に便利）</span>
<span class="hl-keyword">echo</span> <span class="hl-string">"結果を表示します"</span> . <span class="hl-num">PHP_EOL</span>;</code></pre>
            </div>
            <p class="text-sm">Webサーバー経由では <code>$_GET</code> や <code>$_POST</code> を使いますが、CLIツールを作る場合は
                <code>STDIN</code> や <code>$argv</code> を使います。
            </p>
        </section>

        <!-- Section 5: phpinfo() -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                環境の確認 <code>phpinfo()</code>
            </h3>
            <p class="mb-4">PHPの設定やバージョンを詳しく知りたいときは <code>phpinfo();</code> という命令を使います。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-op">&lt;?php</span>
<span class="hl-num">phpinfo</span>(); <span class="hl-comment">// これだけで設定が一覧表示されます</span></code></pre>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800">
                <strong>Warning:</strong> <code>phpinfo()</code>
                はサーバーの内部情報をすべて表示します。制作が終わったら、セキュリティのために必ずファイルを削除するか、外部から見えないようにしましょう。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"記号の一つひとつに、PHPに命令を伝えるための大切な意味があります。"</p>
        </footer>
    </main>

</body>

</html>
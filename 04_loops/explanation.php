<?php
$title = "繰り返し処理（Loops）";
$description = "同じ処理を何度も実行する場合や、データの集まり（配列）を一つずつ取り出す場合に欠かせない仕組みです。";
$lesson_number = 4;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：繰り返し処理 | PHP Loops & Iteration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Fira+Code&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: foreach -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                foreach 文（配列の反復処理）
            </h3>
            <p class="mb-4">配列の各要素を順番に取り出して処理します。PHPで最も使われるループ構文です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 配列の中身を一つずつ $item に代入してループ</span>
<span class="hl-keyword">foreach</span> (<span class="hl-var">$array</span> <span class="hl-keyword">as</span> <span class="hl-var">$item</span>) {
    <span class="hl-comment">// $item を使った処理</span>
}

<span class="hl-comment">// キー（添字）も一緒に取り出す場合</span>
<span class="hl-keyword">foreach</span> (<span class="hl-var">$array</span> <span class="hl-keyword">as</span> <span class="hl-var">$key</span> <span class="hl-op">=&gt;</span> <span class="hl-var">$value</span>) {
    <span class="hl-keyword">echo</span> <span class="hl-var">$key</span> . <span class="hl-string">"は"</span> . <span class="hl-var">$value</span>;
}</code></pre>
            </div>

            <h4 class="font-bold text-slate-900 mb-2 mt-8">HTML内でのコロン構文</h4>
            <p class="mb-4">HTMLタグと組み合わせて使う場合、<code>{ }</code> の代わりに <code>:</code> と <code>endforeach;</code> を使うと、コードの見通しが良くなります。</p>
            <div class="code-block mb-6">
                <pre><code>&lt;ul&gt;
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">foreach</span> (<span class="hl-var">$items</span> <span class="hl-keyword">as</span> <span class="hl-var">$item</span>)<span class="hl-op">:</span> <span class="hl-op">?&gt;</span>
    &lt;li&gt;<span class="hl-op">&lt;?=</span> <span class="hl-var">$item</span> <span class="hl-op">?&gt;</span>&lt;/li&gt;
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">endforeach</span><span class="hl-op">;</span> <span class="hl-op">?&gt;</span>
&lt;/ul&gt;</code></pre>
            </div>
        </section>

        <!-- Section 2: while -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                while 文（条件による反復）
            </h3>
            <p class="mb-4">指定した条件が「真」である限り、処理を繰り返します。回数が決まっていない場合に適しています。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 条件が成立している間ずっと繰り返す</span>
<span class="hl-keyword">while</span> (<span class="hl-var">$loan</span> <span class="hl-op">&gt;</span> <span class="hl-num">0</span>) {
    <span class="hl-var">$loan</span> <span class="hl-op">-=</span> <span class="hl-var">$payment</span>;
    <span class="hl-comment">// ...</span>
}</code></pre>
            </div>
            <div class="bg-rose-50 border-l-4 border-rose-400 p-4 text-sm text-rose-800">
                <strong>Important:</strong> <code>while</code>
                文は、条件がいつまでも「真」のままだと、無限ループに陥ってプログラムが止まらなくなります。必ず終了条件へ近づく処理（変数の更新など）をループ内に含めましょう。
            </div>
        </section>

        <!-- Section 3: for -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                for 文（回数指定による反復）
            </h3>
            <p class="mb-4">「10回繰り返す」など、あらかじめ回数が決まっている場合に便利です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// (初期化; 条件式; 増減式)</span>
<span class="hl-keyword">for</span> (<span class="hl-var">$i</span> <span class="hl-op">=</span> <span class="hl-num">0</span>; <span class="hl-var">$i</span> <span class="hl-op">&lt;</span> <span class="hl-num">10</span>; <span class="hl-var">$i</span><span class="hl-op">++</span>) {
    <span class="hl-keyword">echo</span> <span class="hl-var">$i</span> . <span class="hl-string">"回目の処理"</span>;
}</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"ループと配列を組み合わせることで、大量のデータを一瞬で処理できるようになります。"</p>
        </footer>
    </main>

</body>

</html>
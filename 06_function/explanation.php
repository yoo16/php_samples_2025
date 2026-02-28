<?php
$title = 'PHP基礎：関数（Function）';
$lesson_number = 6;
$description = '特定の処理をひとまとめにして名前をつけたものを「関数」と呼びます。PHPが最初から用意しているもの（ビルトイン関数）と、自分で作るもの（ユーザ定義関数）があります。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：関数 | PHP Functions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include('../components/header.php'); ?>

        <!-- Section 1: Built-in Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                PHPビルトイン関数（標準関数）
            </h3>
            <p class="mb-4">PHPには、データのチェックや文字列の加工など、便利な道具が最初からたくさん用意されています。</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-sm mb-2">データチェック系</h4>
                    <ul class="text-sm space-y-4">
                        <li><code>isset()</code> : 変数があるか確認</li>
                        <li><code>empty()</code> : 中身が空か確認</li>
                        <li><code>is_numeric()</code> : 数値か確認</li>
                    </ul>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200">
                    <h4 class="font-bold text-sm mb-2">文字列・数値操作系</h4>
                    <ul class="text-sm space-y-4">
                        <li><code>mb_strlen()</code> : 文字数を数える</li>
                        <li><code>mb_substr()</code> : 文字を切り出す</li>
                        <li><code>number_format()</code> : 桁区切り</li>
                    </ul>
                </div>
            </div>
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800">
                <strong>Multi-byte Note:</strong> 日本語（全角文字）を扱う場合は、頭に <code>mb_</code> がつく関数（マルチバイト関数）を使うのがルールです。
            </div>
        </section>

        <!-- Section 2: User Defined Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                ユーザ定義関数（自分で作る関数）
            </h3>
            <p class="mb-4"><code>function</code> キーワードを使って、独自の道具を作ることができます。モダンなPHPでは、引数や戻り値に <strong>型</strong> を指定することで、より安全なプログラムを書くことができます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 引数に int、戻り値にも : int を指定して型を厳格にする</span>
<span class="hl-keyword">function</span> <span class="hl-num">calculateSubtotal</span>(<span class="hl-keyword">int</span> <span class="hl-var">$price</span>, <span class="hl-keyword">int</span> <span class="hl-var">$quantity</span>)<span class="hl-op">:</span> <span class="hl-keyword">int</span> 
{
    <span class="hl-keyword">return</span> <span class="hl-var">$price</span> * <span class="hl-var">$quantity</span>;
}

<span class="hl-comment">// ? をつけると「null を返す（または受け取る）可能性がある」ことを示せます</span>
<span class="hl-keyword">function</span> <span class="hl-num">findUser</span>(<span class="hl-keyword">int</span> <span class="hl-var">$id</span>)<span class="hl-op">:</span> <span class="hl-op">?</span><span class="hl-keyword">array</span> 
{
    <span class="hl-comment">// ユーザーが見つからなければ null を返す</span>
    <span class="hl-keyword">return</span> <span class="hl-var">$foundData</span> <span class="hl-op">??</span> <span class="hl-num">null</span>;
}</code></pre>
            </div>
            <ul class="list-disc list-inside space-y-2 text-slate-600 text-sm">
                <li><strong>引数（ひきすう）</strong>: 関数に渡す材料。<code>int</code> や <code>string</code> などの型を指定できます。</li>
                <li><strong>戻り値（もどりち）</strong>: 関数の実行結果。末尾に <code>: 型名</code> と書いて指定します。</li>
                <li><strong>Null許容型</strong>: <code>?string</code> のように書くと、その型または null を扱えるようになります。</li>
            </ul>
        </section>

        <!-- Section 3: Closures and Arrow Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                無名関数とアロー関数
            </h3>
            <p class="mb-4">名前をつけない使い捨ての関数（クロージャ）や、より短く書けるアロー関数もモダンなPHPでは重要です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 無名関数（変数に代入して使う）</span>
<span class="hl-var">$greet</span> = <span class="hl-keyword">function</span>(<span class="hl-var">$name</span>) {
    <span class="hl-keyword">return</span> <span class="hl-string">"Hello, {</span><span class="hl-var">$name</span><span class="hl-string">}"</span>;
};

<span class="hl-comment">// アロー関数（1行の計算などに便利 / PHP 7.4+）</span>
<span class="hl-var">$tax</span> = <span class="hl-keyword">fn</span>(<span class="hl-var">$p</span>) <span class="hl-op">=&gt;</span> <span class="hl-var">$p</span> * <span class="hl-num">1.1</span>;</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"共通の処理を関数にまとめることで、修正が一箇所で済み、ミスが減り、読みやすいコードになります。"</p>
        </footer>
    </main>

</body>

</html>
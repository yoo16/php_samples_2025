<?php
$title = "条件分岐（if / match）";
$description = "プログラムの流れを「もし〜なら」という条件によって分岐させる、最も重要な制御構造について学びます。";
$lesson_number = 3;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：条件分岐 | PHP Control Structures</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: if Statement -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                if 文の基本とコロン構文
            </h3>
            <p class="mb-4">最も一般的な分岐です。HTML内に記述する場合は、<code>{ }</code> の代わりに <code>:</code> と <code>endif;</code> を使う「コロン構文」がよく使われます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 通常の構文</span>
<span class="hl-keyword">if</span> (<span class="hl-var">$isAuth</span>) {
    <span class="hl-keyword">echo</span> <span class="hl-string">"ログイン中"</span>;
} <span class="hl-keyword">else</span> {
    <span class="hl-keyword">echo</span> <span class="hl-string">"ゲスト"</span>;
}

<span class="hl-comment">// HTML内でのコロン構文（menu.phpで使用）</span>
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">if</span> (<span class="hl-var">$isAuth</span>)<span class="hl-op">:</span> <span class="hl-op">?&gt;</span>
    &lt;li&gt;マイページ&lt;/li&gt;
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">else</span><span class="hl-op">:</span> <span class="hl-op">?&gt;</span>
    &lt;li&gt;サインイン&lt;/li&gt;
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">endif</span><span class="hl-op">;</span> <span class="hl-op">?&gt;</span></code></pre>
            </div>
        </section>

        <!-- Section 2: Nested if -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                入れ子（ネスト）構造
            </h3>
            <p class="mb-4">if文の中にさらにif文を入れることで、複雑な条件を表現できます。<code>payment.php</code> では「メンテナンス中か？」を確認した後に「残高は足りているか？」を判定しています。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">if</span> (<span class="hl-var">$isMaintenance</span>) {
    <span class="hl-var">$message</span> = <span class="hl-string">"休止中"</span>;
} <span class="hl-keyword">else</span> {
    <span class="hl-keyword">if</span> (<span class="hl-var">$charge</span> <span class="hl-op">&gt;=</span> <span class="hl-var">$payment</span>) {
        <span class="hl-var">$message</span> = <span class="hl-string">"決済成功"</span>;
    } <span class="hl-keyword">else</span> {
        <span class="hl-var">$message</span> = <span class="hl-string">"残高不足"</span>;
    }
}</code></pre>
            </div>
        </section>

        <!-- Section 3: match Expression -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                PHP 8.0 新機能：match 式
            </h3>
            <p class="mb-4"><code>switch</code> 文の進化版です。値を返すことができるため、変数への代入が非常にスッキリ書けます。<code>garbage.php</code> で活用しています。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 厳密な比較 (===) が行われ、breakも不要です</span>
<span class="hl-var">$garbage</span> = <span class="hl-keyword">match</span> (<span class="hl-var">$weekIndex</span>) {
    <span class="hl-num">1</span>, <span class="hl-num">3</span>   <span class="hl-op">=&gt;</span> <span class="hl-string">"燃えるゴミ"</span>,
    <span class="hl-num">5</span>      <span class="hl-op">=&gt;</span> <span class="hl-string">"燃えないゴミ"</span>,
    <span class="hl-keyword">default</span> <span class="hl-op">=&gt;</span> <span class="hl-string">"回収なし"</span>,
};</code></pre>
            </div>
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800">
                <strong>Tips:</strong> <code>switch</code> 文は「ゆるい比較(==)」、<code>match</code> 式は「厳密な比較(===)」という違いがあります。
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"条件分岐をマスターすれば、ユーザーの状態に合わせたパーソナライズが可能になります。"</p>
        </footer>
    </main>

</body>

</html>
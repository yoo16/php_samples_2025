<?php
$title = "配列の操作（Arrays）";
$description = "複数のデータをまとめて扱う「配列」は、Web制作において最も頻繁に利用されるデータ形式です。";
$lesson_number = 5;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：配列とデータ構造 | PHP Arrays & Objects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: Indexed Arrays -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                インデックス配列
            </h3>
            <p class="mb-4">番号（0, 1, 2...）でデータを管理する、最もシンプルな配列です。<code>[]</code> を使って定義します。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$drinks</span> = [<span class="hl-string">"コーラ"</span>, <span class="hl-string">"お茶"</span>, <span class="hl-string">"水"</span>];
<span class="hl-keyword">echo</span> <span class="hl-var">$drinks</span>[<span class="hl-num">0</span>]; <span class="hl-comment">// コーラが表示される</span></code></pre>
            </div>
            <p class="text-sm italic text-slate-500">※インデックスは必ず 0 から始まることに注意しましょう。</p>
        </section>

        <!-- Section 2: Associative Arrays -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                連想配列（キーと値のペア）
            </h3>
            <p class="mb-4">番号の代わりに「名前（キー）」をつけてデータを管理します。PHPではオブジェクトのような用途で非常によく使われます。<code>users.php</code>
                のデータ構造はこの形式です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$user</span> = [
    <span class="hl-string">"id"</span> <span class="hl-op">=&gt;</span> <span class="hl-num">1</span>,
    <span class="hl-string">"name"</span> <span class="hl-op">=&gt;</span> <span class="hl-string">"Chris"</span>,
    <span class="hl-string">"role"</span> <span class="hl-op">=&gt;</span> <span class="hl-string">"Admin"</span>
];
<span class="hl-keyword">echo</span> <span class="hl-var">$user</span>[<span class="hl-string">"name"</span>]; <span class="hl-comment">// Chrisが表示される</span></code></pre>
            </div>
        </section>

        <!-- Section 3: Multidimensional Arrays -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                多次元配列（配列の入れ子）
            </h3>
            <p class="mb-4">「配列の中に配列」を入れることで、表形式のような複雑なデータ構造を表現できます。<code>user/index.php</code> で一覧表示しているデータはこの形式です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$users</span> = [
    [<span class="hl-string">"id"</span> <span class="hl-op">=&gt;</span> <span class="hl-num">1</span>, <span class="hl-string">"name"</span> <span class="hl-op">=&gt;</span> <span class="hl-string">"Chris"</span>],
    [<span class="hl-string">"id"</span> <span class="hl-op">=&gt;</span> <span class="hl-num">2</span>, <span class="hl-string">"name"</span> <span class="hl-op">=&gt;</span> <span class="hl-string">"Bob"</span>],
];
<span class="hl-comment">// 2番目のユーザーの名前を取得</span>
<span class="hl-keyword">echo</span> <span class="hl-var">$users</span>[<span class="hl-num">1</span>][<span class="hl-string">"name"</span>];</code></pre>
            </div>
        </section>

        <!-- Section 4: Array Functions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                便利な配列関数
            </h3>
            <p class="mb-4">PHPには配列を操作するための関数が豊富に用意されています。</p>

            <div class="space-y-4 mb-8">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>count($array)</code></h4>
                    <p class="text-sm text-slate-600">配列の要素の数を数えます。一覧の件数表示などに使います。</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>isset($array["key"])</code></h4>
                    <p class="text-sm text-slate-600">指定したキーが存在するか確認します。エラーを防ぐために必須です。</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>array_push($array, $item)</code></h4>
                    <p class="text-sm text-slate-600">配列の末尾に新しいデータを追加します（<code>$array[] = $item</code> とも書けます）。</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>explode(",", $string)</code></h4>
                    <p class="text-sm text-slate-600">文字列を指定した区切り文字で分解して、配列に変換します（CSV読み込みなどで活躍）。</p>
                </div>
            </div>
        </section>

        <!-- Section 5: Searching Arrays -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                多次元配列からのデータ検索
            </h3>
            <p class="mb-4"><code>detail.php</code> のように、特定の ID を持つデータを検索する方法は主に3つあります。</p>

            <h4 class="font-bold text-slate-900 mb-2 mt-8">A. <code>foreach</code> を使う（基本）</h4>
            <p class="text-sm text-slate-600 mb-4">最も標準的で、どの言語でも共通の考え方です。見つかったら <code>break</code> でループを抜けるのがポイントです。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">foreach</span> (<span class="hl-var">$users</span> <span class="hl-keyword">as</span> <span class="hl-var">$u</span>) {
    <span class="hl-keyword">if</span> (<span class="hl-var">$u</span>[<span class="hl-string">'id'</span>] === <span class="hl-var">$id</span>) {
        <span class="hl-var">$user</span> = <span class="hl-var">$u</span>;
        <span class="hl-keyword">break</span>;
    }
}</code></pre>
            </div>

            <h4 class="font-bold text-slate-900 mb-2 mt-8">B. <code>array_filter</code> を使う（モダン）</h4>
            <p class="text-sm text-slate-600 mb-4">条件に合う要素だけを抽出します。PHP 7.4 以降の「アロー関数（<code>fn()</code>）」を使うと非常にスッキリ書けます。
            </p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$result</span> = <span class="hl-num">array_filter</span>(<span class="hl-var">$users</span>, <span class="hl-keyword">fn</span>(<span class="hl-var">$u</span>) <span class="hl-op">=&gt;</span> <span class="hl-var">$u</span>[<span class="hl-string">'id'</span>] === <span class="hl-var">$id</span>);
<span class="hl-var">$user</span> = <span class="hl-var">$result</span> <span class="hl-op">?</span> <span class="hl-num">reset</span>(<span class="hl-var">$result</span>) <span class="hl-op">:</span> <span class="hl-num">null</span>;</code></pre>
            </div>

            <h4 class="font-bold text-slate-900 mb-2 mt-8">C. <code>array_column</code> と <code>array_search</code> を使う
            </h4>
            <p class="text-sm text-slate-600 mb-4">IDだけの配列を <code>array_column</code> で作り、そこから <code>array_search</code>
                で位置を特定します。一行で特定のプロパティを狙い撃ちできます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$key</span> = <span class="hl-num">array_search</span>(<span class="hl-var">$id</span>, <span class="hl-num">array_column</span>(<span class="hl-var">$users</span>, <span class="hl-string">'id'</span>), <span class="hl-num">true</span>);
<span class="hl-var">$user</span> = (<span class="hl-var">$key</span> <span class="hl-op">!==</span> <span class="hl-num">false</span>) <span class="hl-op">?</span> <span class="hl-var">$users</span>[<span class="hl-var">$key</span>] <span class="hl-op">:</span> <span class="hl-num">null</span>;</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"多次元の連想配列を使いこなせば、あらゆるデータベースの情報を自在に扱えるようになります。"</p>
        </footer>
    </main>

</body>

</html>
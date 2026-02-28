<?php
$title = 'PHP基礎：変数と演算';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：変数と演算 | PHP Variables & Operations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Fira+Code&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <header class="mb-12">
            <div
                class="inline-block px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold uppercase tracking-wider mb-4">
                Lesson 02</div>
            <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">変数と演算の基本</h2>
            <p class="text-lg text-slate-600">情報を一時的に保存する「変数」や「定数」、そして計算を行う「演算」は、プログラミングの土台となる最も重要な要素です。</p>
        </header>

        <!-- Section 1: Variables -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                変数の宣言と代入
            </h3>
            <p class="mb-4">PHPでは <code>$</code>
                記号を使って変数を宣言します。文字列、数値、真偽値（boolean）など、様々なデータ型を格納できます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 文字列の代入</span>
<span class="hl-var">$drink1</span> = <span class="hl-string">"コーラ"</span>;
<span class="hl-var">$image1</span> = <span class="hl-string">"images/cola.webp"</span>;

<span class="hl-comment">// 数値の代入</span>
<span class="hl-var">$price1</span> = <span class="hl-num">120</span>;
<span class="hl-var">$quantity1</span> = <span class="hl-num">1</span>;

<span class="hl-comment">// 真偽値の代入（会員かどうか）</span>
<span class="hl-var">$isMember</span> = <span class="hl-num">true</span>;</code></pre>
            </div>
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 text-sm text-blue-800">
                <strong>Point:</strong> PHPは動的型付け言語なので、変数の型を明示的に指定する必要はありません。
            </div>
        </section>

        <!-- Section 2: String Concatenation -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                文字列の連結と変数展開
            </h3>
            <p class="mb-4">複数の文字列を繋げたり、文字列の中に変数の値を埋め込んだりする方法を学びます。</p>

            <h4 class="font-bold text-slate-900 mb-2">ドット演算子 <code>.</code> による連結</h4>
            <p class="text-sm text-slate-600 mb-4">PHPでは <code>.</code> （ドット）を使って文字列を繋げます。JavaScriptの <code>+</code> にあたる役割です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-var">$full_name</span> = <span class="hl-var">$last_name</span> <span class="hl-op">.</span> <span class="hl-string">" "</span> <span class="hl-op">.</span> <span class="hl-var">$first_name</span>;</code></pre>
            </div>

            <h4 class="font-bold text-slate-900 mb-2">変数展開（ダブルクォート <code>" "</code>）</h4>
            <p class="text-sm text-slate-600 mb-4">ダブルクォートで囲った文字列の中では、<code>{$変数名}</code> と書くことで直接変数の値を埋め込むことができます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 変数を波括弧 {} で囲むのが安全で推奨される書き方です</span>
<span class="hl-var">$full_name</span> = <span class="hl-string">"{</span><span class="hl-var">$last_name</span><span class="hl-string">} {</span><span class="hl-var">$first_name</span><span class="hl-string">}"</span>;</code></pre>
            </div>
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800 font-medium">
                Note: シングルクォート <code>' '</code> の中では変数展開は行われず、そのままの文字として扱われます。
            </div>
        </section>

        <!-- Section 3: Superglobals -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                特別な変数「スーパーグローバル」
            </h3>
            <p class="mb-4">PHPには、プログラマが自分で作る変数のほかに、システムが最初から用意してくれている <strong>スーパーグローバル変数</strong> があります。これらはプログラムのどこからでもアクセスできる特別な連想配列です。</p>

            <div class="space-y-4 mb-6">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>$_GET</code></h4>
                    <p class="text-sm text-slate-600">URLの末尾に付いた <code>?name=Taro</code> などの情報（URLパラメータ）を受け取ります。主に「検索」や「ページの切り替え」に使われます。</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>$_POST</code></h4>
                    <p class="text-sm text-slate-600">お問い合わせフォームやログイン画面など、ユーザーが入力したデータを送信する際に使われます。</p>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-2"><code>$_SERVER</code></h4>
                    <p class="text-sm text-slate-600">サーバー自体の名前や、アクセスした人のIPアドレス、使用しているブラウザの種類などの情報が入っています。</p>
                </div>
            </div>

            <div class="code-block">
                <pre><code><span class="hl-comment">// URLパラメータ "?name=Yamada" がある場合、その値を取得できる</span>
<span class="hl-var">$name</span> = <span class="hl-var">$_GET</span>[<span class="hl-string">'name'</span>] <span class="hl-op">??</span> <span class="hl-string">'ゲスト'</span>;

<span class="hl-comment">// サーバーの名前を取得</span>
<span class="hl-var">$host</span> = <span class="hl-var">$_SERVER</span>[<span class="hl-string">'SERVER_NAME'</span>];</code></pre>
            </div>
        </section>

        <!-- Section 4: Constants -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                定数の定義
            </h3>
            <p class="mb-4">一度決めたら値を変更したくないもの（消費税率や割引率など）には、<code>const</code> を使って定数を定義します。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 定数は慣習として大文字で記述します</span>
<span class="hl-const">const</span> <span class="hl-const">DISCOUNT_RATE</span> = <span class="hl-num">0.1</span>;
<span class="hl-const">const</span> <span class="hl-const">POINT_RATE</span> = <span class="hl-num">0.01</span>;</code></pre>
            </div>
        </section>

        <!-- Section 5: Operations -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                算術演算とインクリメント
            </h3>
            <p class="mb-4">四則演算（<code>+</code>, <code>-</code>, <code>*</code>, <code>/</code>）のほか、値を1増やす
                <code>++</code>（インクリメント）や1減らす <code>--</code>（デクリメント）もよく使われます。
            </p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// インクリメント（数量を1増やす）</span>
<span class="hl-var">$quantity1</span><span class="hl-op">++</span>;

<span class="hl-comment">// 金額の計算（単価 × 数量）</span>
<span class="hl-var">$amount1</span> = <span class="hl-var">$price1</span> <span class="hl-op">*</span> <span class="hl-var">$quantity1</span>;

<span class="hl-comment">// 全商品の合計</span>
<span class="hl-var">$total</span> = <span class="hl-var">$amount1</span> <span class="hl-op">+</span> <span class="hl-var">$amount2</span> <span class="hl-op">+</span> <span class="hl-var">$amount3</span>;</code></pre>
            </div>
        </section>

        <!-- Section 6: Ternary Operator -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">6</span>
                三項演算子
            </h3>
            <p class="mb-4">簡単な条件分岐には、if文よりも短く書ける <strong>三項演算子</strong> <code>(条件) ? 真の場合 : 偽の場合</code> が便利です。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 会員なら定数の割引率を適用、そうでなければ0</span>
<span class="hl-var">$discountRate</span> = (<span class="hl-var">$isMember</span>) <span class="hl-op">?</span> <span class="hl-const">DISCOUNT_RATE</span> <span class="hl-op">:</span> <span class="hl-num">0</span>;

<span class="hl-comment">// 表示ラベルの切り替え</span>
<span class="hl-var">$memberLabel</span> = (<span class="hl-var">$isMember</span>) <span class="hl-op">?</span> <span class="hl-string">"会員"</span> <span class="hl-op">:</span> <span class="hl-string">"非会員"</span>;</code></pre>
            </div>
        </section>

        <!-- Section 7: HTML Output -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">7</span>
                HTMLへの出力
            </h3>
            <p class="mb-4">計算結果を画面に表示する際は、<code>&lt;?= ... ?&gt;</code>（ショートエコータグ）を使うとシンプルに記述できます。
            </p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">&lt;!-- 数値をカンマ区切りで表示 --&gt;</span>
&lt;span&gt;&yen;<span class="hl-op">&lt;?=</span> <span class="hl-num">number_format</span>(<span class="hl-var">$total</span>) <span class="hl-op">?&gt;</span>&lt;/span&gt;

<span class="hl-comment">&lt;!-- 動的にクラス名を切り替える（会員なら色を変える等） --&gt;</span>
&lt;span class="<span class="hl-op">&lt;?=</span> <span class="hl-var">$isMember</span> <span class="hl-op">?</span> <span class="hl-string">'bg-emerald-500'</span> <span class="hl-op">:</span> <span class="hl-string">'bg-slate-200'</span> <span class="hl-op">?&gt;</span>"&gt;
    <span class="hl-op">&lt;?=</span> <span class="hl-var">$memberLabel</span> <span class="hl-op">?&gt;</span>
&lt;/span&gt;</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"変数を使えば、一度の変更でプログラム全体の振る舞いを調整できます。"</p>
        </footer>
    </main>

</body>

</html>

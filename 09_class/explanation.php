<?php
$title = 'PHP応用：オブジェクト指向（クラス）';
$lesson_number = 9;
$description = 'クラス、継承、多態性（ポリモーフィズム）といったOOPの核心概念に加え、実務で必須となる「責務の分離（MVC）」や「CSRF対策のカプセル化」をカードバトルの設計を通じて学びます。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：オブジェクト指向 | PHP Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include('../components/header.php'); ?>

        <!-- Section 1: Polymorphism -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                ポリモーフィズム (多態性)
            </h3>
            <p class="mb-4">同じメソッド名でも、インスタンス化されたクラスによって振る舞いが変わる性質です。<code>CardGame</code> クラスは、どのカードが選ばれても <code>useSpecialSkill()</code> を呼ぶだけで、適切な威力を自動的に計算できます。</p>

            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// $player は KnightCard かもしれないし AquaCard かもしれない</span>
<span class="hl-var">$dmg</span> = <span class="hl-var">$this</span>-><span class="hl-var">player</span>-><span class="hl-num">useSpecialSkill</span>(); 
<span class="hl-comment">// どちらであっても、共通の親クラス BaseCard の型として扱える</span></code></pre>
            </div>
        </section>

        <!-- Section 2: Encapsulation -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                セキュリティ機能のカプセル化
            </h3>
            <p class="mb-4">CSRF対策（トークンの生成や検証）といった汎用的なロジックも、<code>CardGame</code> クラスの中に閉じ込めています（カプセル化）。これにより、利用側は「セキュリティの仕組み」を詳細に知らなくても、安全な機能を実装できます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 利用側（select.php / battle.php）</span>
<span class="hl-var">$token</span> = <span class="hl-var">$game</span>-><span class="hl-num">getCsrfToken</span>();

<span class="hl-comment">// 利用側（action.php）</span>
<span class="hl-keyword">if</span> (!<span class="hl-var">$game</span>-><span class="hl-num">validateCsrfToken</span>(<span class="hl-var">$_POST</span>[<span class="hl-string">'csrf_token'</span>])) { ... }</code></pre>
            </div>
        </section>

        <!-- Section 3: Separation of Concerns -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                責務の分離と PRGパターン
            </h3>
            <p class="mb-4">プログラムを役割ごとに分離し、POST処理後にリダイレクトを行う「PRGパターン」を採用しています。</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl border border-slate-200">
                    <strong class="text-indigo-600 block mb-1">select/index.php / battle/index.php</strong>
                    <p class="text-xs text-slate-500">View：表示のみを担当。バトル中かどうかの判定を行い、適切に遷移します。</p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200">
                    <strong class="text-amber-600 block mb-1">action/index.php</strong>
                    <p class="text-xs text-slate-500">Controller：入力(POST)を受け取り、セキュリティ検証とロジック実行後、リダイレクトします。</p>
                </div>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"OOPを使うことで、ビジネスロジックとセキュリティ、表示を美しく整理できます。"</p>
        </footer>
    </main>

</body>

</html>
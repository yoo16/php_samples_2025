<?php
$title = 'PHP応用：オブジェクト指向（クラス）';
$lesson_number = 9;
$description = 'クラス、継承、抽象クラス、インターフェースといったオブジェクト指向の核心となる概念を学びます。カードバトルの設計を通じて、これらがどう役立つかを体験しましょう。';
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

        <!-- Section 1: Inheritance -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                継承 (Inheritance)
            </h3>
            <p class="mb-4">既存のクラス（親クラス）のプロパティやメソッドを引き継いで、新しいクラス（子クラス）を作る仕組みです。共通の「カード」としての機能を <code>BaseCard</code> にまとめ、具体的な「モンスター」を <code>MonsterCard</code> で作ることができます。</p>

            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 親クラス：全てのカードの共通点</span>
<span class="hl-keyword">abstract class</span> <span class="hl-num">BaseCard</span> { ... }

<span class="hl-comment">// 子クラス：具体的なカードの個性</span>
<span class="hl-keyword">class</span> <span class="hl-num">MonsterCard</span> <span class="hl-keyword">extends</span> <span class="hl-num">BaseCard</span> { ... }</code></pre>
            </div>
        </section>

        <!-- Section 2: Abstract Classes -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                抽象クラス (Abstract Class)
            </h3>
            <p class="mb-4">「具体的な内容は決まっていないが、名前だけ決めておく」というメソッド（抽象メソッド）を持つクラスです。これにより、子クラスで必ずその機能を実装することを強制できます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">abstract class</span> <span class="hl-num">BaseCard</span> 
{
    <span class="hl-comment">// 子クラスで必ず「スキル使用」の実装が必要になる</span>
    <span class="hl-keyword">abstract public function</span> <span class="hl-num">useSpecialSkill</span>()<span class="hl-op">:</span> <span class="hl-keyword">int</span>;
}</code></pre>
            </div>
        </section>

        <!-- Section 3: Interfaces -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                インターフェース (Interface)
            </h3>
            <p class="mb-4">クラスが持つべき機能を外部から規定する「規約」です。継承と違い、全く異なる種類のクラスに対しても同じ操作（例：攻撃ができる、計算ができる）を保証できます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">interface</span> <span class="hl-num">CardInterface</span> 
{
    <span class="hl-keyword">public function</span> <span class="hl-num">getAttackPower</span>()<span class="hl-op">:</span> <span class="hl-keyword">int</span>;
}</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"OOPを使うことで、プログラムを現実世界の『モノ（オブジェクト）』の組み合わせとして整理でき、拡張が容易になります。"</p>
        </footer>
    </main>

</body>

</html>

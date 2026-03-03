<?php
$title = 'PHP応用：MySQL データベース操作';
$lesson_number = 10;
$description = 'PHPからデータベース(MySQL)を操作するための標準的な手段である「PDO」の使い方と、実務で必須となる「プリペアードステートメント」による安全な実装方法を解説します。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：MySQL操作 | PHP PDO</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include('../components/header.php'); ?>

        <!-- Section 1: DB & Schema -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                DB作成とスキーマ定義
            </h3>
            <p class="mb-4">アプリケーションを開始する前に、器となるデータベースと、データの構造を定義するテーブル（スキーマ）を作成する必要があります。</p>

            <h4 class="font-bold text-slate-700 mb-2 text-sm uppercase tracking-wider">データベースの作成</h4>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">CREATE DATABASE IF NOT EXISTS</span> php_sns;
<span class="hl-keyword">USE</span> php_sns;</code></pre>
            </div>

            <h4 class="font-bold text-slate-700 mb-2 text-sm uppercase tracking-wider">主要なテーブル定義 (users)</h4>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">CREATE TABLE</span> users (
    id <span class="hl-keyword">bigint PRIMARY KEY AUTO_INCREMENT</span>,
    account_name <span class="hl-keyword">varchar</span>(255) <span class="hl-keyword">UNIQUE NOT NULL</span>,
    email <span class="hl-keyword">varchar</span>(255) <span class="hl-keyword">UNIQUE NOT NULL</span>,
    display_name <span class="hl-keyword">varchar</span>(255) <span class="hl-keyword">NOT NULL</span>,
    password <span class="hl-keyword">varchar</span>(255) <span class="hl-keyword">NOT NULL</span>,
    created_at <span class="hl-keyword">datetime DEFAULT CURRENT_TIMESTAMP</span>
);</code></pre>
            </div>
            <p class="text-sm text-slate-500 italic">※ このサンプルでは <code>tweets</code> テーブルとの間に <strong>外部キー制約</strong> を設定し、データの整合性を保っています。</p>
        </section>

        <!-- Section 2: PDO & Security -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                PDO接続とプリペアードステートメント
            </h3>
            <p class="mb-4">PHPでデータベースを安全に扱うには <strong>PDO</strong> と <strong>プリペアードステートメント</strong> が不可欠です。</p>

            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 接続実行</span>
<span class="hl-var">$pdo</span> = <span class="hl-keyword">new</span> <span class="hl-num">PDO</span>(<span class="hl-var">$dsn</span>, <span class="hl-var">$user</span>, <span class="hl-var">$pass</span>);

<span class="hl-comment">// SQLの準備（プレースホルダを使う）</span>
<span class="hl-var">$stmt</span> = <span class="hl-var">$pdo</span>-><span class="hl-num">prepare</span>(<span class="hl-string">"SELECT * FROM users WHERE id = :id"</span>);

<span class="hl-comment">// 安全に実行</span>
<span class="hl-var">$stmt</span>-><span class="hl-num">execute</span>([<span class="hl-string">'id'</span> <span class="hl-op">=></span> <span class="hl-var">$id</span>]);</code></pre>
            </div>
        </section>

        <!-- Section 3: CRUD Examples -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                CRUD 操作のサンプルSQL
            </h3>

            <div class="space-y-8">
                <!-- CREATE -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-indigo-600">
                        <span class="px-2 py-0.5 bg-indigo-100 rounded text-[10px] font-black uppercase tracking-widest">Create</span>
                        <h4 class="font-bold">データの挿入 (INSERT)</h4>
                    </div>
                    <div class="code-block text-sm">
                        <pre><code><span class="hl-keyword">INSERT INTO</span> users (account_name, email, display_name, password)
<span class="hl-keyword">VALUES</span> (<span class="hl-string">:account_name</span>, <span class="hl-string">:email</span>, <span class="hl-string">:display_name</span>, <span class="hl-string">:password</span>);</code></pre>
                    </div>
                </div>

                <!-- READ -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-emerald-600">
                        <span class="px-2 py-0.5 bg-emerald-100 rounded text-[10px] font-black uppercase tracking-widest">Read</span>
                        <h4 class="font-bold">データの取得 (SELECT)</h4>
                    </div>
                    <div class="code-block text-sm">
                        <pre><code><span class="hl-comment">-- 全件取得</span>
<span class="hl-keyword">SELECT</span> * <span class="hl-keyword">FROM</span> users <span class="hl-keyword">LIMIT</span> <span class="hl-num">50</span>;

<span class="hl-comment">-- IDによる特定</span>
<span class="hl-keyword">SELECT</span> * <span class="hl-keyword">FROM</span> users <span class="hl-keyword">WHERE</span> id = <span class="hl-string">:id</span>;</code></pre>
                    </div>
                </div>

                <!-- UPDATE -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-amber-600">
                        <span class="px-2 py-0.5 bg-amber-100 rounded text-[10px] font-black uppercase tracking-widest">Update</span>
                        <h4 class="font-bold">データの更新 (UPDATE)</h4>
                    </div>
                    <div class="code-block text-sm">
                        <pre><code><span class="hl-keyword">UPDATE</span> users 
<span class="hl-keyword">SET</span> display_name = <span class="hl-string">:name</span>, password = <span class="hl-string">:password</span>
<span class="hl-keyword">WHERE</span> id = <span class="hl-string">:id</span>;</code></pre>
                    </div>
                </div>

                <!-- DELETE -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-2 mb-4 text-rose-600">
                        <span class="px-2 py-0.5 bg-rose-100 rounded text-[10px] font-black uppercase tracking-widest">Delete</span>
                        <h4 class="font-bold">データの削除 (DELETE)</h4>
                    </div>
                    <div class="code-block text-sm">
                        <pre><code><span class="hl-keyword">DELETE FROM</span> users <span class="hl-keyword">WHERE</span> id = <span class="hl-string">:id</span>;</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Table Join -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-purple-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                応用：テーブル結合 (JOIN)
            </h3>
            <p class="mb-4">正規化されたテーブル同士を結合し、関連する情報を一度に取得します。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">-- 投稿内容と一緒に、投稿者の表示名を取得する例</span>
<span class="hl-keyword">SELECT</span> t.message, u.display_name, t.created_at
<span class="hl-keyword">FROM</span> tweets t
<span class="hl-keyword">JOIN</span> users u <span class="hl-keyword">ON</span> t.user_id = u.id
<span class="hl-keyword">WHERE</span> t.user_id = <span class="hl-string">:user_id</span>;</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"データベースを自在に扱えるようになると、SNSや掲示板、ECサイトなど、あらゆる動的サイトが構築可能になります。"</p>
        </footer>
    </main>

</body>

</html>
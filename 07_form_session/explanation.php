<?php
$title = 'PHP基礎：フォームとセッション';
$lesson_number = 7;
$description = 'ユーザーからのデータ送信（GET/POST）と、ページを跨いで情報を保持するセッションの仕組みについて学びましょう。';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：フォームとセッション | PHP Form & Session</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Fira+Code&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include('../components/header.php'); ?>

        <!-- Section 1: GET vs POST -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                GET と POST の違い
            </h3>
            <p class="mb-4">フォームからデータを送る方法には主に2つあります。用途に合わせて使い分けるのが重要です。</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-sky-600 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        GET メソッド
                    </h4>
                    <p class="text-sm text-slate-600 leading-relaxed">URLの末尾に <code>?key=value</code> 形式でデータを付加します。</p>
                    <ul class="mt-4 text-sm space-y-2 text-slate-500">
                        <li>✅ 検索結果やページ番号に向いている</li>
                        <li>✅ URLをコピーして共有・ブックマークできる</li>
                        <li>❌ パスワードなどの機密送信には不向き</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-rose-600 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        POST メソッド
                    </h4>
                    <p class="text-sm text-slate-600 leading-relaxed">URLには出さず、リクエストの内部（ボディ）にデータを隠して送ります。</p>
                    <ul class="mt-4 text-sm space-y-2 text-slate-500">
                        <li>✅ ログイン情報や個人情報の送信に向いている</li>
                        <li>✅ 大容量のデータ（ブログ記事等）を送れる</li>
                        <li>❌ URL共有で同じ結果は表示できない</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Section 2: Session Basics -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                セッションによる状態保持
            </h3>
            <p class="mb-4">HTTPリクエストは本来「一回きり」で情報を忘れ去りますが、<code>$_SESSION</code> を使うと<strong>ページを移動してもデータを保持</strong>できます。</p>

            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// セッションを使うすべてのファイルの先頭で必須</span>
<span class="hl-num">session_start</span>();

<span class="hl-comment">// データの保存</span>
<span class="hl-var">$_SESSION</span>[<span class="hl-string">'user_name'</span>] = <span class="hl-string">'田中'</span>;

<span class="hl-comment">// データの取得</span>
<span class="hl-var">$name</span> = <span class="hl-var">$_SESSION</span>[<span class="hl-string">'user_name'</span>] <span class="hl-op">??</span> <span class="hl-string">'ゲスト'</span>;</code></pre>
            </div>
        </section>

        <!-- Section 3: Redirect & PRG Pattern -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-emerald-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                リダイレクトとPRGパターン
            </h3>
            <p class="mb-4 text-sm leading-relaxed">
                <code>post_receive.php</code> で行っているように、POST送信を受けた後に <code>header()</code> を使って<strong>別のページへ飛ばす（リダイレクト）</strong>手法を <strong>PRGパターン</strong> と呼びます。
                これにより、ブラウザの「更新」ボタンを押してもフォームが再送信されるのを防ぎ、ユーザー体験と安全性を向上させます。
            </p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 指定したURLへ即座に移動させる</span>
<span class="hl-num">header</span>(<span class="hl-string">'Location: post_request.php'</span>);
<span class="hl-keyword">exit</span>; <span class="hl-comment">// リダイレクト後は必ず処理を終了させる</span></code></pre>
            </div>
        </section>

        <!-- Section 4: Clearing Sessions -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-slate-800 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                セッションのクリア（ログアウト / フラッシュメッセージ）
            </h3>
            <p class="mb-4">特定のデータを消すには <code>unset()</code>、セッションすべてを破棄するには <code>session_destroy()</code> を使います。<code>logout.php</code> で活用しています。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 特定のキーだけ削除（ログアウト処理など）</span>
<span class="hl-keyword">unset</span>(<span class="hl-var">$_SESSION</span>[<span class="hl-string">'authUser'</span>]);

<span class="hl-comment">// すべてのセッションデータを空にする</span>
<span class="hl-var">$_SESSION</span> = [];</code></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"フォームとセッションを組み合わせることで、初めて『アプリケーション』らしい双方向のやり取りが可能になります。"</p>
        </footer>
    </main>

</body>

</html>
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

        <!-- Section 0: What is PHP -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">0</span>
                PHPとは
            </h3>
            <p class="mb-4"><strong>PHP</strong>（PHP: Hypertext Preprocessor）は、<strong>Webページを動的に作るためのサーバーサイドプログラミング言語</strong>です。1994年に誕生し、WordPressをはじめ世界中の多くのWebサイトで使われています。</p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-sky-50 rounded-2xl p-5">
                    <div class="text-2xl mb-2">🖥️</div>
                    <h4 class="font-bold text-slate-800 mb-1">サーバーで動く</h4>
                    <p class="text-sm text-slate-600">PHPはユーザーのブラウザではなく、Webサーバー上で実行されます。処理結果のHTMLだけがブラウザに送られます。</p>
                </div>
                <div class="bg-sky-50 rounded-2xl p-5">
                    <div class="text-2xl mb-2">🔗</div>
                    <h4 class="font-bold text-slate-800 mb-1">HTMLに埋め込める</h4>
                    <p class="text-sm text-slate-600">HTMLファイルの中に直接PHPコードを書けます。デザイン（HTML）とロジック（PHP）を一つのファイルにまとめられます。</p>
                </div>
                <div class="bg-sky-50 rounded-2xl p-5">
                    <div class="text-2xl mb-2">🗄️</div>
                    <h4 class="font-bold text-slate-800 mb-1">DBと連携できる</h4>
                    <p class="text-sm text-slate-600">MySQLなどのデータベースと簡単に連携し、ログイン機能や投稿の保存・取得といった動的な処理を実現できます。</p>
                </div>
            </div>

            <div class="bg-slate-100 rounded-2xl p-6 text-md mb-6">
                <p class="font-bold text-slate-700 mb-3">リクエストからレスポンスまでの流れ</p>
                <div class="flex flex-wrap items-center gap-2 font-mono text-md text-center">
                    <div class="bg-white rounded-xl px-6 py-2 shadow-sm border border-slate-200">ブラウザ<br><span class="text-slate-400">URLを入力</span></div>
                    <span class="text-sky-400 font-bold">→</span>
                    <div class="bg-white rounded-xl px-6 py-2 shadow-sm border border-slate-200">Webサーバー<br><span class="text-slate-400">PHPを実行</span></div>
                    <span class="text-sky-400 font-bold">→</span>
                    <div class="bg-white rounded-xl px-6 py-2 shadow-sm border border-slate-200">データベース<br><span class="text-slate-400">データ取得</span></div>
                    <span class="text-sky-400 font-bold">→</span>
                    <div class="bg-sky-500 text-white rounded-xl px-6 py-2 shadow-sm">HTML生成<br><span class="text-sky-200">ブラウザへ送信</span></div>
                </div>
            </div>

            <div class="bg-red-50 border-l-4 border-red-400 p-5 rounded-r-2xl">
                <p class="font-bold text-red-700 mb-3">⚠️ PHPはWebサーバー上でしか動きません</p>
                <p class="text-sm text-red-800 mb-4"><code>.php</code> ファイルをブラウザで直接開いても、PHPコードはそのまま文字として表示されるだけです。必ずWebサーバーを経由してアクセスする必要があります。</p>
                <div class="grid grid-cols-1 gap-3 text-md">
                    <div class="bg-white rounded-xl p-4 border border-red-100">
                        <p class="font-bold text-slate-700 mb-2">Windows / Mac（開発環境）</p>
                        <ul class="space-y-1 text-slate-600">
                            <li><strong>XAMPP</strong> — <code>C:\xampp\htdocs\</code> に置いて <code>http://localhost/</code> でアクセス</li>
                            <li class="pt-1"><strong>MAMP</strong> — <code>/Applications/MAMP/htdocs/</code> に置いて <code>http://localhost:8888/</code> または <code>http://localhost/</code> でアクセス</li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-red-100">
                        <p class="font-bold text-slate-700 mb-2">Linux（本番 / VPS）</p>
                        <ul class="space-y-1 text-slate-600">
                            <li><strong>Apache</strong> — <code>/var/www/html/</code> などに置く</li>
                            <li class="pt-1"><strong>Nginx</strong> — 設定ファイルの <code>root</code> ディレクティブで指定したパスに置く</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 1: Tags -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
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
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
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
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                文の終わり <code>;</code>
            </h3>
            <p class="mb-4">一つの命令が終わるごとに、必ず <code>;</code>
                （セミコロン）をつけます。日本語で言う「。」（句点）のような役割です。これを忘れると、PHPはどこまでが命令なのか分からず止まってしまいます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-keyword">echo</span> <span class="hl-string">"おはよう"</span><span class="hl-op">;</span>
<span class="hl-keyword">echo</span> <span class="hl-string">"おやすみ"</span><span class="hl-op">;</span></code></pre>
            </div>
        </section>

        <!-- Section 4: Comments -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                コメント
            </h3>
            <p class="mb-4">コメントはプログラムとして実行されない「メモ書き」です。コードの意図を説明したり、一時的に処理を無効化するときに使います。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-comment">// 一行コメント：行末まで無視されます</span>

<span class="hl-comment">/*
 * 複数行コメント
 * 長い説明を書くときに使います
 */</span>

<span class="hl-comment">/**
 * DocBlockコメント（PHPDoc）
 * 関数やクラスの直前に書く公式なドキュメントコメントです
 * IDEがこの情報を読み取って補完に活用します
 *
 * @param string $name 名前
 * @return string 挨拶文
 */</span>
<span class="hl-keyword">function</span> <span class="hl-num">greet</span>(<span class="hl-var">$name</span>) {
    <span class="hl-keyword">return</span> <span class="hl-string">"こんにちは、"</span> . <span class="hl-var">$name</span> . <span class="hl-string">"さん！"</span>;
}</code></pre>
            </div>
            <p class="text-sm">HTMLの中でもPHPのコメントは使えますが、<code>&lt;!-- --&gt;</code>（HTMLコメント）とは異なり、PHPコメントはブラウザに送信されません。ソースコードを「表示」しても見えないため、より安全です。</p>
        </section>

        <!-- Section 5: PHP and HTML Affinity -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                HTMLとの親和性
            </h3>
            <p class="mb-4">PHPの大きな特徴は、<strong>HTMLファイルの中にそのまま書ける</strong>ことです。<code>&lt;?php ... ?&gt;</code> で囲んだ部分だけPHPとして実行され、それ以外は普通のHTMLとして出力されます。</p>
            <div class="code-block mb-6">
                <pre><code><span class="hl-op">&lt;?php</span> <span class="hl-var">$name</span> = <span class="hl-string">"太郎"</span>; <span class="hl-op">?&gt;</span>

<span class="hl-comment">&lt;!-- ここからHTML。PHPの変数を埋め込めます --&gt;</span>
&lt;h1&gt;こんにちは、<span class="hl-op">&lt;?=</span> <span class="hl-var">$name</span> <span class="hl-op">?&gt;</span> さん！&lt;/h1&gt;

<span class="hl-op">&lt;?php</span> <span class="hl-keyword">if</span> (<span class="hl-var">$name</span> === <span class="hl-string">"太郎"</span>): <span class="hl-op">?&gt;</span>
    &lt;p&gt;管理者としてログイン中です。&lt;/p&gt;
<span class="hl-op">&lt;?php</span> <span class="hl-keyword">endif</span>; <span class="hl-op">?&gt;</span></code></pre>
            </div>
            <p class="mb-4 text-sm"><code>&lt;?= $変数 ?&gt;</code> は <code>&lt;?php echo $変数; ?&gt;</code> の短縮形です。HTMLへの値の埋め込みによく使われます。</p>
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 text-sm text-amber-800">
                <strong>仕組み：</strong> ブラウザがHTMLを受け取る前に、サーバー上でPHPが実行されます。ブラウザに届くのは完成済みのHTMLだけです。これが「サーバーサイド言語」と呼ばれる理由です。
            </div>
        </section>

        <!-- Section 6: CLI Demo Explanation -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">6</span>
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

        <!-- Section 7: phpinfo() -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span
                    class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">7</span>
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
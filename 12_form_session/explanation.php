<?php
$title = 'フォームとセッション';
$description = 'ユーザーからのデータ送信（GET/POST）と、ページをまたいで情報を保持するセッションの仕組みを、検索シミュレーター（get_request.php）と認証シミュレーター（post_request.php）の実例で学びましょう。';
$lesson_number = 8;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>解説：フォームとセッション | PHP Form & Session</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Prism.js for code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include '../components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <?php include '../components/header.php'; ?>

        <!-- Section 1: GET vs POST -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                GET と POST の違い
            </h3>
            <p class="mb-6">フォームからデータを送る方法には主に2つあります。<code>method</code> 属性で指定し、用途に合わせて使い分けることが重要です。</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-sky-600 mb-3">GET メソッド</h4>
                    <p class="text-sm text-slate-600 mb-4">URLの末尾に <code>?key=value</code> 形式でデータを付加します。<code>get_request.php</code> の検索フォームがこれにあたります。</p>
                    <ul class="text-sm space-y-1 text-slate-500">
                        <li>✅ 検索・フィルターなど結果を共有したい場合に向く</li>
                        <li>✅ URLをブックマーク・コピーして再現できる</li>
                        <li>❌ パスワードなどの機密送信には不向き</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-[2rem] border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-rose-600 mb-3">POST メソッド</h4>
                    <p class="text-sm text-slate-600 mb-4">URLには出さず、リクエストの内部（ボディ）にデータを隠して送ります。<code>post_request.php</code> のログインフォームがこれにあたります。</p>
                    <ul class="text-sm space-y-1 text-slate-500">
                        <li>✅ ログイン情報・個人情報の送信に向く</li>
                        <li>✅ 大容量データも送れる</li>
                        <li>❌ URLに状態が現れないため共有・ブックマーク不可</li>
                    </ul>
                </div>
            </div>

            <pre class="language-php mb-4"><code class="language-php">&lt;!-- GET：URLに ?keyword=PHP&category=Web が付く --&gt;
&lt;form action="" method="get"&gt;
    &lt;input type="text" name="keyword" value="PHP"&gt;
    &lt;input type="text" name="category" value="Web"&gt;
    &lt;button type="submit"&gt;検索&lt;/button&gt;
&lt;/form&gt;

&lt;!-- POST：URLにデータは出ない --&gt;
&lt;form action="post_receive.php" method="post"&gt;
    &lt;input type="text"     name="email"    value="user@example.com"&gt;
    &lt;input type="password" name="password" value="..."&gt;
    &lt;button type="submit"&gt;ログイン&lt;/button&gt;
&lt;/form&gt;</code></pre>

            <div class="bg-sky-50 border-l-4 border-sky-400 p-4 text-sm text-sky-800 rounded-r-2xl">
                <strong>XSS対策：</strong> フォームの値を画面に表示するときは、必ず <code>htmlspecialchars()</code> でエスケープしましょう。<code>&lt;</code> や <code>&gt;</code> などの特殊文字を無害な文字列に変換し、スクリプト埋め込みを防ぎます。
            </div>
        </section>

        <!-- Section 2: GET Request -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-sky-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                GETリクエストの受け取り
            </h3>
            <p class="mb-4"><code>$_GET</code> は送信されたすべての GETパラメータを連想配列として保持するスーパーグローバル変数です。<code>get_request.php</code> ではフォームから受け取ったデータを画面に表示しています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// $_GET にすべての GETパラメータが入る
// URL: get_request.php?keyword=PHP&category=Web の場合
$queries  = $_GET;

// ?? 演算子でキーが存在しない場合のデフォルト値を設定
$keyword  = $queries['keyword']  ?? '';
$category = $queries['category'] ?? '';

// 画面への出力は必ず htmlspecialchars() でエスケープ
echo htmlspecialchars($keyword);  // "PHP"

// $queries が空か確認して出し分け
if (empty($queries)) {
    // まだ送信されていない
} else {
    // $queries をループして受信データを一覧表示
    foreach ($queries as $key => $value) {
        echo htmlspecialchars($key) . ': ' . htmlspecialchars($value);
    }
}

// $_SERVER['REQUEST_URI'] で現在のURLパス＋クエリ文字列を取得
echo $_SERVER['REQUEST_URI']; // "/12_form_session/get_request.php?keyword=PHP&..."</code></pre>

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm text-slate-600">
                <code>$_GET</code> は送信前（URLにパラメータなし）は空の配列 <code>[]</code> です。<code>empty($_GET)</code> で「まだ送信されていない」状態を判定できます。
            </div>
        </section>

        <!-- Section 3: Session Basics -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-indigo-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                セッションによる状態保持
            </h3>
            <p class="mb-4">HTTPは本来「一回きり」で情報を忘れますが、<code>$_SESSION</code> を使うと<strong>ページを移動してもデータを保持</strong>できます。<code>post_request.php</code> では、ログイン状態とフラッシュメッセージをセッションで管理しています。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
// セッションを使うすべてのファイルの先頭で必ず呼ぶ
session_start();

// セッションからデータを取得（なければデフォルト値）
$posts    = $_SESSION['previous_post'] ?? [];
$status   = $_SESSION['status']        ?? '';
$authUser = $_SESSION['authUser']      ?? null;

// フラッシュメッセージ：1回表示したら削除する
function flashMessage(): string
{
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']); // 取り出したら即削除
        return $message;
    }
    return '';
}

$message = flashMessage();

// status は表示後に削除（リロードで再表示されないように）
unset($_SESSION['status']);</code></pre>

            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-4 text-sm text-indigo-800 rounded-r-2xl">
                <strong>フラッシュメッセージ：</strong> 「ログイン成功しました」のように<strong>1回だけ表示して消えるメッセージ</strong>をフラッシュメッセージといいます。セッションに保存して、読み取った直後に <code>unset()</code> するパターンが定番です。
            </div>
        </section>

        <!-- Section 4: POST & PRG Pattern -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-rose-500 text-white rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                POSTの受け取りとPRGパターン
            </h3>
            <p class="mb-4"><code>post_receive.php</code> は POST データを受け取り、認証チェックを行ってからリダイレクトします。この <strong>Post/Redirect/Get（PRGパターン）</strong>により、ブラウザの再読み込みでフォームが二重送信されるのを防ぎます。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
session_start();

// テストユーザー情報（実際はデータベースで管理する）
const TEST_USER = [
    'name'     => '東京 太郎',
    'email'    => 'user@example.com',
    'password' => 'password123'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email']    ?? '';
    $password = $_POST['password'] ?? '';

    // 入力値をセッションに保存（フォームの復元用）
    $_SESSION['previous_post'] = $_POST;

    // 認証検証
    if ($email === TEST_USER['email'] && $password === TEST_USER['password']) {
        // 認証成功
        $_SESSION['status']   = 'success';
        $_SESSION['authUser'] = TEST_USER;
        $_SESSION['message']  = 'ログインに成功しました。';

        // パスワードはセッションに残さない（セキュリティの基本）
        unset($_SESSION['previous_post']['password']);
    } else {
        // 認証失敗
        $_SESSION['status']  = 'error';
        $_SESSION['message'] = 'メールアドレスまたはパスワードが正しくありません。';
    }
}

// PRGパターン：処理後は必ずリダイレクト
header('Location: post_request.php');
exit; // header() の後は必ず exit でスクリプトを終了する</code></pre>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-sm mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">ステップ</th>
                            <th class="px-6 py-3 text-left">処理</th>
                            <th class="px-6 py-3 text-left">ファイル</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        <tr>
                            <td class="px-6 py-3 font-bold text-rose-600">Post</td>
                            <td class="px-6 py-3">フォームを POST 送信</td>
                            <td class="px-6 py-3 font-mono text-xs">post_request.php</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold text-amber-600">Redirect</td>
                            <td class="px-6 py-3">受信・検証後にリダイレクト</td>
                            <td class="px-6 py-3 font-mono text-xs">post_receive.php</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-3 font-bold text-emerald-600">Get</td>
                            <td class="px-6 py-3">セッションを読んで結果を表示</td>
                            <td class="px-6 py-3 font-mono text-xs">post_request.php</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-rose-50 border-l-4 border-rose-400 p-4 text-sm text-rose-800 rounded-r-2xl">
                <strong>なぜ exit が必要か：</strong> <code>header()</code> はレスポンスヘッダを設定するだけで、スクリプトの実行は続きます。<code>exit</code> を書かないと、リダイレクト後も後続のコードが実行されてしまいます。
            </div>
        </section>

        <!-- Section 5: Logout / Session Destroy -->
        <section class="mb-16">
            <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                <span class="w-8 h-8 bg-slate-700 text-white rounded-lg flex items-center justify-center mr-3 text-sm">5</span>
                セッションのクリア（ログアウト）
            </h3>
            <p class="mb-4">ログアウト処理は <code>logout.php</code> で行います。<code>unset()</code> で特定のキーを削除してから、ログインページへリダイレクトします。</p>

            <pre class="language-php mb-6"><code class="language-php">&lt;?php
session_start();

// 特定のキーだけ削除（必要なセッションは残せる）
if (isset($_SESSION['authUser'])) {
    unset($_SESSION['authUser']);
    unset($_SESSION['message']);
    unset($_SESSION['status']);
}

// ログインページへリダイレクト
header('Location: post_request.php');
exit;</code></pre>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-slate-50 border border-slate-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-slate-800 mb-1"><code>unset($_SESSION['key'])</code></p>
                    <p class="text-slate-600">特定のキーだけ削除。他のセッションデータは残る。ログアウトや個別データの削除に使う。</p>
                </div>
                <div class="bg-slate-50 border border-slate-200 p-4 rounded-2xl text-sm">
                    <p class="font-bold text-slate-800 mb-1"><code>$_SESSION = []</code> + <code>session_destroy()</code></p>
                    <p class="text-slate-600">すべてのセッションデータを空にしてからセッション自体を破棄。完全な初期化が必要なときに使う。</p>
                </div>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"フォームとセッションを組み合わせることで、初めて『アプリケーション』らしい双方向のやり取りが可能になります。"</p>
        </footer>
    </main>

    <!-- Prism.js Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
</body>

</html>

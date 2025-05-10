<?php
// 共通ファイル app.php を読み込み
require_once '../app.php';

// TODO: セッション（auth_user) からログインチェック
if (empty($_SESSION['auth_user'])) {
    // ログインしていない場合はログイン画面にリダイレクト
    header('Location: ../login/input.php');
    exit;
}

// TODO: セッション（auth_user) からユーザ情報を取得
$user = $_SESSION['auth_user'];
?>

<!DOCTYPE html>
<html lang="ja">

<!-- コンポーネント: components/head.php -->
<?php include COMPONENT_DIR . 'head.php'; ?>

<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

    <main class="bg-white shadow-lg rounded-xl p-8 w-full max-w-xl">
        <?php if (!empty($user)): ?>
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">ユーザ情報</h2>
                <p class="text-gray-600">ようこそ、<span class="font-bold"><?= $user['name'] ?></span> さん</p>
                <a href="home/logout.php" class="my-2 block w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Logout</a>
            </div>
        <?php endif ?>

        <form action="https://www.google.com/search" method="get" class="space-y-4">
            <div>
                <label for="q" class="block text-sm font-medium text-gray-700 mb-1">検索キーワード</label>
                <input type="text" name="q" id="q" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                🔍 Google検索
            </button>
        </form>
    </main>

</body>

</html>
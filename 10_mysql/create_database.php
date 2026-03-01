<?php
require_once 'env.php';

session_start();

// CSRFトークンの生成
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$message = "";
$status = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRFトークンの検証
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('不正なリクエストです。');
    }

    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4";
        $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        // 1. データベース作成
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_DATABASE;
        $pdo->exec($sql);

        // 2. データベース選択
        $sql = "USE " . DB_DATABASE;
        $pdo->exec($sql);

        // 3. スキーマ作成
        $sqlFile = "docs/schema.sql";
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $pdo->exec($sql);
            $message .= "✅ データベーススキーマを作成しました。" . PHP_EOL;
        } else {
            throw new Exception("SQLファイルが見つかりません: " . $sqlFile);
        }

        // 4. 初期データ挿入
        $sqlFile = "docs/insert_data.sql";
        if (file_exists($sqlFile)) {
            $sql = file_get_contents($sqlFile);
            $pdo->exec($sql);
            $message .= "✅ 初期データの挿入が完了しました。" . PHP_EOL;
        } else {
            $message .= "⚠️ 初期データSQLファイルが見つかりませんでした。" . PHP_EOL;
        }
        $status = "success";
    } catch (Exception $e) {
        $status = "error";
        $message = "❌ エラーが発生しました: " . $e->getMessage();
    }
}

$title = 'データベース初期化';
$lesson_number = 10;
$description = 'MySQL データベースの作成、テーブルの定義（スキーマ）、および初期データの投入を一括で行います。';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | PHP Samples</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight text-slate-900"><?= $title ?></h1>
            <a href="index.php" class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition">&larr; データベースメニュー</a>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-6 py-12">

        <header class="mb-12">
            <div class="inline-block px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold uppercase tracking-wider mb-4">
                Lesson <?= $lesson_number ?>
            </div>
            <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight"><?= $title ?></h2>
            <p class="text-lg text-slate-600"><?= $description ?></p>
        </header>

        <?php if ($status === 'success'): ?>
            <div class="mb-12 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl animate-in fade-in zoom-in duration-300">
                <div class="flex items-center gap-3 mb-4 text-emerald-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">セットアップ完了</h3>
                </div>
                <div class="bg-white/50 p-4 rounded-xl font-mono text-sm text-emerald-800 leading-loose">
                    <?= nl2br(htmlspecialchars($message)) ?>
                </div>
                <div class="mt-6">
                    <a href="select_users.php" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-200">
                        ユーザ一覧を確認する
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        <?php elseif ($status === 'error'): ?>
            <div class="mb-12 p-6 bg-rose-50 border border-rose-200 rounded-2xl">
                <div class="flex items-center gap-3 mb-4 text-rose-700">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold">セットアップ失敗</h3>
                </div>
                <p class="text-rose-800 font-medium"><?= nl2br(htmlspecialchars($message)) ?></p>
                <p class="mt-4 text-sm text-rose-600"><code>.env</code> の設定内容（ホスト、ユーザ名、パスワード）が正しいか確認してください。</p>
            </div>
        <?php endif; ?>

        <!-- Setup Form -->
        <section class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            <div class="p-8 bg-slate-900 text-white">
                <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    実行前の注意
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    この操作を実行すると、データベース <strong><?= DB_DATABASE ?></strong> が初期化されます。<br>
                    既にテーブルが存在する場合は上書き（再作成）され、現在のデータは全て削除されますのでご注意ください。
                </p>
            </div>

            <form action="" method="post" class="p-8">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="space-y-6">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">実行される内容</h4>
                        <ul class="text-sm text-slate-600 space-y-2">
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                データベースの作成 (CREATE DATABASE)
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                テーブルの定義 (docs/schema.sql)
                            </li>
                            <li class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                テストデータの投入 (docs/insert_data.sql)
                            </li>
                        </ul>
                    </div>

                    <button type="submit" class="w-full py-4 bg-sky-600 hover:bg-sky-700 text-white font-bold rounded-2xl transition shadow-lg shadow-sky-200 flex items-center justify-center gap-2 group">
                        <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        セットアップを実行する
                    </button>
                    <a href="index.php" class="w-full py-4 bg-slate-600 hover:bg-slate-700 text-white font-bold rounded-2xl transition shadow-lg shadow-slate-200 flex items-center justify-center gap-2 group">
                        一覧に戻る
                    </a>
                </div>
            </form>
        </section>

        <footer class="pt-12 mt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"開発環境の構築を自動化することで、チーム全員が同じデータ状態で開発を開始できます。"</p>
        </footer>
    </main>

</body>

</html>
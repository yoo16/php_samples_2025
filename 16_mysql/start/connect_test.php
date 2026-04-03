<?php
// connect_test.php
// 環境変数を読み込む
require_once './env.php';

// 接続情報を変数に代入（完成品）
$db_connection = DB_CONNECTION;
$db_name       = DB_DATABASE;
$db_host       = DB_HOST;
$db_port       = DB_PORT;
$db_user       = DB_USERNAME;
$db_password   = DB_PASSWORD;

// --------------------------------------------------------
// (2) DSN（データソース名）を組み立てる
//     ヒント: "{$db_connection}:dbname={$db_name};host=...;port=...;charset=utf8;"
// --------------------------------------------------------
$dsn = "{$db_connection}:dbname={$db_name};host={$db_host};port={$db_port};charset=utf8;";

// --------------------------------------------------------
// (3) PDO インスタンスを生成して MySQL に接続する
// --------------------------------------------------------
$pdo = null; // 初期値（接続前は null）

try {
    // (3-a) PDO オブジェクトを生成する
    $pdo = new PDO($dsn, $db_user, $db_password);

    // --------------------------------------------------------
    // (4) エラーモードを「例外スロー」に設定する
    // --------------------------------------------------------
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 答え合わせ用
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    // 接続失敗時はエラーメッセージを表示して終了
    $error_message = $e->getMessage();
}

// ステータス判定
$is_connected = isset($pdo) && $pdo instanceof PDO;
$status_color = $is_connected ? 'emerald' : 'rose';
$status_text = $is_connected ? '接続成功' : '接続失敗';

$title = 'MySQL接続テスト';
$lesson_number = 10;
$description = 'PDO (PHP Data Objects) を使用して、MySQL データベースへの接続を確認します。環境変数（.env）の設定が正しく反映されているかチェックしましょう。';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | PHP Samples</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/app.css">
</head>

<body class="bg-slate-50 text-slate-800 leading-relaxed antialiased">

    <?php include 'components/nav.php'; ?>

    <main class="max-w-4xl mx-auto px-6 py-12">

        <header class="mb-12">
            <div class="inline-block px-3 py-1 rounded-full bg-sky-100 text-sky-700 text-xs font-bold uppercase tracking-wider mb-4">
                Lesson <?= $lesson_number ?>
            </div>
            <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight"><?= $title ?></h2>
            <p class="text-lg text-slate-600"><?= $description ?></p>
        </header>

        <!-- Status Card -->
        <section class="mb-12">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-8 flex flex-col md:flex-row items-center gap-6">
                    <div class="w-20 h-20 rounded-full bg-<?= $status_color ?>-100 flex items-center justify-center flex-shrink-0">
                        <?php if ($is_connected): ?>
                            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        <?php else: ?>
                            <svg class="w-10 h-10 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold text-slate-900 mb-1">データベース接続ステータス</h3>
                        <p class="text-<?= $status_color ?>-600 font-bold flex items-center justify-center md:justify-start gap-2">
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-<?= $status_color ?>-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-<?= $status_color ?>-500"></span>
                            </span>
                            <?= $status_text ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Connection Details -->
        <section class="mb-12">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
                構成情報 (.env)
            </h3>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase text-[10px] font-bold tracking-widest">
                        <tr>
                            <th class="px-6 py-4">設定項目</th>
                            <th class="px-6 py-4">現在の値</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php
                        $configs = [
                            'DB_CONNECTION' => $db_connection,
                            'DB_HOST'       => $db_host,
                            'DB_PORT'       => $db_port,
                            'DB_DATABASE'   => $db_name,
                            'DB_USERNAME'   => $db_user,
                            'DB_PASSWORD'   => '********' // セキュリティのためマスク
                        ];
                        foreach ($configs as $key => $val): ?>
                            <tr>
                                <td class="px-6 py-4 font-mono font-bold text-slate-500 uppercase"><?= $key ?></td>
                                <td class="px-6 py-4 font-mono text-sky-600"><?= htmlspecialchars($val) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- PDO Object Info -->
        <section class="mb-12">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                PDO オブジェクト詳細
            </h3>
            <div class="bg-slate-900 rounded-2xl p-6 shadow-lg overflow-x-auto">
                <pre class="text-emerald-400 font-mono text-xs leading-relaxed"><?php var_dump($pdo); ?></pre>
            </div>
        </section>

        <footer class="pt-12 border-t border-slate-200 text-center">
            <p class="text-slate-500 text-sm italic">"PDOを使用することで、データベースの種類に依存しない抽象化されたアクセスが可能になります。"</p>
        </footer>
    </main>

</body>

</html>
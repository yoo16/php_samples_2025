<?php
// 1. 開始タグ <?php で始めます

// 2. 変数: $ 記号を名前の前につけてデータを保存します
$message = "こんにちは、PHPの世界へ！";
$version = phpversion(); // PHPのバージョンを取得

// 3. 文末: 命令の終わりには必ず ; (セミコロン) をつけます

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World | PHP基礎</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-900 min-h-screen flex items-center justify-center p-4">
    <main class="max-w-xl w-full">
        <!-- Result Card -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-indigo-100 overflow-hidden border border-white p-10 text-center">
            <div class="inline-block px-4 py-1.5 mb-6 rounded-full bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-[0.2em]">
                Successfully Executed
            </div>

            <h1 class="font-outfit text-5xl font-black text-slate-900 tracking-tighter mb-6">
                Hello <span class="text-indigo-600">PHP!</span>
            </h1>

            <div class="bg-slate-50 rounded-3xl p-8 mb-8 border border-slate-100">
                <p class="text-xl font-bold text-slate-700 leading-relaxed">
                    <!-- 変数の中身を表示します -->
                    <?= $message ?>
                </p>
            </div>

            <!-- カンマ(,)を使って複数のデータを続けて出力するデモ -->
            <div class="flex items-center justify-center gap-2 text-slate-400 font-bold text-xs uppercase tracking-widest">
                <span>Environment:</span>
                <span class="text-indigo-500 bg-indigo-50 px-2 py-1 rounded-lg">PHP <?= $version ?></span>
            </div>
        </div>

        <!-- Explanation Link -->
        <div class="mt-10 text-center">
            <a href="explanation.php" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                このコードの解説を見る
            </a>
        </div>
    </main>
</body>

</html>
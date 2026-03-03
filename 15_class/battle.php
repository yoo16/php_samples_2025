<?php
// クラスを読み込む
require_once __DIR__ . '/services/GameService.php';

// セッションを開始する
session_start();

$game = new GameService();

// カード選択があった場合、プレイヤーを初期化
if ($cardId = $_GET['card_id'] ?? '') {
    $game->setupPlayer($cardId);
}

// カードがなければ、選択画面へ
if (!$game->player) {
    header('Location: select_card.php');
    exit;
}

// 敵カードがなければ決定
$game->setupEnemy();

// ボタンが押された時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game->handleAction($_POST['action'] ?? '');
}

// ビュー用変数
$player = $game->player;
$enemy = $game->enemy;
$message = $game->message;
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アクション実行</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/game.css">
</head>

<body class="bg-slate-400 text-slate-100 min-h-screen">
    <main class="max-w-5xl mx-auto px-4 py-4">
        <div class="text-center mb-2">
            <h1 class="text-4xl font-game font-black text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-cyan-400 tracking-widest uppercase mb-4">Battle Simulation</h1>
        </div>

        <!-- アクションログ -->
        <div class="max-w-2xl mx-auto bg-slate-900/80 rounded-xl p-4 my-2 border border-slate-700 shadow-inner min-h-[4rem] flex items-center justify-center">
            <p class="text-base font-bold text-center text-slate-200 leading-relaxed"><?= nl2br($message) ?></p>
        </div>

        <!-- 操作パネル -->
        <form method="POST" class="flex flex-wrap justify-center gap-4">
            <button type="submit" name="action" value="attack" class="px-8 py-3 bg-gradient-to-r from-rose-600 to-rose-700 hover:from-rose-500 hover:to-rose-600 rounded-lg font-game font-bold shadow-lg shadow-rose-900/40 transition-all active:scale-95 border-b-4 border-rose-900">
                ATTACK
            </button>
            <button type="submit" name="action" value="special" class="px-8 py-3 bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-500 hover:to-sky-600 rounded-lg font-game font-bold shadow-lg shadow-sky-900/40 transition-all active:scale-95 border-b-4 border-sky-900">
                SPECIAL SKILL
            </button>
            <button type="submit" name="action" value="gain_exp" class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 rounded-lg font-game font-bold shadow-lg shadow-emerald-900/40 transition-all active:scale-95 border-b-4 border-emerald-900">
                GAIN EXP
            </button>
            <button type="submit" name="action" value="reset" class="px-8 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg font-game font-bold shadow-lg shadow-slate-900/40 transition-all active:scale-95 border-b-4 border-slate-900">
                RESET
            </button>
        </form>

        <!-- カード -->
        <div class="flex flex-col md:flex-row justify-center items-start gap-6 my-2">
            <!-- プレイヤーカード -->
            <div class="tcg-card player-card rounded-2xl p-4 w-full max-w-xs shadow-xl">
                <h2 class="text-sm font-game font-bold mb-3 text-sky-400 border-b border-sky-400/30 pb-1">Player Unit</h2>
                <?php $card = $player;
                include 'views/card.php'; ?>
                <div class="mt-3 bg-slate-900 rounded-full h-3 overflow-hidden border border-slate-700">
                    <div class="hp-bar bg-sky-500 h-full" style="width: <?= ($player->hp / $player->maxHp) * 100 ?>%"></div>
                </div>
                <div class="flex justify-between text-[10px] font-game mt-1 px-1 text-slate-400">
                    <span>HP: <?= $player->hp ?> / <?= $player->maxHp ?></span>
                    <span>EXP: <?= $player->exp ?></span>
                </div>
            </div>

            <!-- ログエリア（デスクトップでは中央、モバイルでは間） -->
            <div class="hidden md:flex flex-col justify-center items-center w-32 self-stretch">
                <div class="h-full w-px bg-gradient-to-b from-transparent via-slate-700 to-transparent"></div>
                <div class="py-4 text-slate-500 font-game text-xs uppercase tracking-widest [writing-mode:vertical-lr]">Battle Log</div>
                <div class="h-full w-px bg-gradient-to-b from-transparent via-slate-700 to-transparent"></div>
            </div>

            <!-- エネミーカード -->
            <div class="tcg-card enemy-card rounded-2xl p-4 w-full max-w-xs shadow-xl">
                <h2 class="text-sm font-game font-bold mb-3 text-rose-400 border-b border-rose-400/30 pb-1">Enemy Unit</h2>
                <?php $card = $enemy;
                include 'views/card.php'; ?>
                <div class="mt-3 bg-slate-900 rounded-full h-3 overflow-hidden border border-slate-700">
                    <div class="hp-bar bg-rose-500 h-full" style="width: <?= ($enemy->hp / $enemy->maxHp) * 100 ?>%"></div>
                </div>
                <div class="flex justify-between text-[10px] font-game mt-1 px-1 text-slate-400">
                    <span>HP: <?= $enemy->hp ?> / <?= $enemy->maxHp ?></span>
                </div>
            </div>
        </div>


        <div class="mt-10 text-center">
            <a href="select_card.php" class="text-slate-300 hover:text-sky-400 transition-colors underline decoration-sky-800">カード選択に戻る</a>
        </div>
    </main>
</body>

</html>
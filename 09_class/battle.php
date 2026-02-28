<?php
require_once 'app.php';

// バトル中でなければ選択画面へ
if (!isset($_SESSION['game_data'])) {
    header('Location: select.php');
    exit;
}

$game = new CardGame();
$csrf_token = $game->getCsrfToken();

$player = $game->getPlayer();
$enemy = $game->getEnemy();
$logs = $game->getLogs();
$isGameOver = $game->isGameOver();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_TITLE ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/game.css">
</head>

<body class="bg-slate-950 text-slate-100 min-h-screen">
    <main class="max-w-5xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start animate-in fade-in duration-1000">
            <!-- Cards Section -->
            <div class="lg:col-span-8 space-y-12">
                <!-- Enemy Side -->
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-end justify-end">
                    <div class="flex-1 w-full max-w-md text-right order-2 md:order-1">
                        <div class="mb-2">
                            <span class="text-[10px] font-game font-bold text-rose-500 uppercase tracking-[0.3em] bg-rose-500/10 px-3 py-1 rounded-full border border-rose-500/20">Target Enemy</span>
                            <h3 class="text-2xl font-game font-black mt-2"><?= $enemy->name ?></h3>
                        </div>
                        <div class="flex items-end justify-end gap-4 mb-2">
                            <div class="text-right">
                                <span class="text-ms font-game text-rose-500 block mb-1">MP: <?= $enemy->mp ?></span>
                            </div>
                            <p class="text-3xl font-game font-black text-rose-500"><?= $enemy->hp ?><span class="text-lg text-white ml-1">/100</span></p>
                        </div>
                        <div class="w-full bg-slate-900 h-4 rounded-full overflow-hidden border border-slate-800 p-0.5">
                            <div class="hp-bar bg-gradient-to-r from-rose-600 to-rose-400 h-full rounded-full" style="width: <?= $enemy->hp ?>%"></div>
                        </div>
                    </div>
                    <div class="w-48 shrink-0 order-1 md:order-2">
                        <div class="tcg-card enemy-card rounded-2xl p-2 rotate-2">
                            <div class="card-image-frame aspect-[3/4] rounded-xl overflow-hidden">
                                <img src="<?= $enemy->image ?>" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Player Side -->
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                    <div class="w-48 shrink-0">
                        <div class="tcg-card player-card rounded-2xl p-2 -rotate-2">
                            <div class="card-image-frame aspect-[3/4] rounded-xl overflow-hidden">
                                <img src="<?= $player->image ?>" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full max-w-md">
                        <div class="mb-2">
                            <span class="text-[10px] font-game font-bold text-indigo-400 uppercase tracking-[0.3em] bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">Player</span>
                            <h3 class="text-2xl font-game font-black mt-2"><?= $player->name ?></h3>
                        </div>
                        <div class="flex items-end gap-4 mb-2">
                            <p class="text-3xl font-game font-black text-emerald-400"><?= $player->hp ?><span class="text-lg text-white ml-1">/100</span></p>
                            <div>
                                <span class="text-ms font-game text-indigo-400 block mt-1">MP: <?= $player->mp ?></span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-900 h-4 rounded-full overflow-hidden border border-slate-800 p-0.5">
                            <div class="hp-bar bg-gradient-to-r from-emerald-600 to-emerald-400 h-full rounded-full" style="width: <?= $player->hp ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Battle Logs Section -->
            <div class="lg:col-span-4 sticky top-4">

                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-sm font-game font-black text-white uppercase tracking-[0.4em]">Battle Feed</h3>
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                </div>

                <!-- Actions -->
                <div class="mb-2">
                    <?php if (!$isGameOver): ?>
                        <form action="action.php" method="post" class="mt-2 grid grid-cols-2 gap-4">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <button type="submit" name="action" value="attack" class="bg-slate-800 hover:bg-slate-700 py-4 rounded-xl font-game font-bold transition-all border border-slate-700 flex flex-col items-center">
                                <span class="text-xl mb-1">⚔️</span><span class="text-[10px] tracking-widest text-slate-400">ATTACK</span>
                            </button>
                            <button type="submit" name="action" value="skill" <?= $player->mp <= 0 ? 'disabled' : '' ?> class="bg-slate-800 hover:bg-slate-700 disabled:opacity-30 py-4 rounded-xl font-game font-bold transition-all border border-slate-700 flex flex-col items-center shadow-lg">
                                <span class="text-xl mb-1">✨</span><span class="text-[10px] tracking-widest text-slate-400">SPECIAL SKILL</span>
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="action.php" method="post" class="mt-10">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <button type="submit" name="reset" value="1" class="w-full bg-slate-100 hover:bg-white text-slate-950 py-5 rounded-xl font-game font-black transition-all flex items-center justify-center gap-3">
                                RE-TRY
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="bg-slate-900/50 rounded-3xl border border-slate-800 p-6 h-[600px] overflow-y-auto font-mono text-sm space-y-4">
                    <?php foreach (array_reverse($logs) as $log): ?>
                        <div class="log-entry">
                            <p class="inline">
                                <?= nl2br($log) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
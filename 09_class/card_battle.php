<?php
require_once 'models/CardGame.php';

session_start();

// CSRFトークンの生成（未発行なら）
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

$game = new CardGame();
$availableCards = CardGame::getAvailableCards();

// ゲーム状況の確認
$isStarted = isset($_SESSION['game_data']);

// データ取得
if ($isStarted) {
    $player = $game->getPlayer();
    $enemy = $game->getEnemy();
    $playerHp = $game->getPlayerHp();
    $enemyHp = $game->getEnemyHp();
    $logs = $game->getLogs();
    $isGameOver = $game->isGameOver();
}

$title = 'PHP応用：カードバトル (Polymorphism)';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | PHP Samples</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .hp-bar { transition: width 0.5s ease-in-out; }
        .card-img { object-fit: cover; width: 100%; height: 100%; }
    </style>
</head>

<body class="bg-slate-900 text-slate-100 leading-relaxed antialiased min-h-screen">

    <?php include('../components/nav.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-12">
        
        <?php if (!$isStarted): ?>
            <!-- Selection Screen -->
            <section class="animate-in fade-in zoom-in duration-500">
                <h3 class="text-2xl font-black text-center mb-10 text-indigo-400 tracking-widest uppercase tracking-[0.3em]">Select Your Card</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ($availableCards as $id => $card): ?>
                        <form action="card_action.php" method="post" class="group">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <input type="hidden" name="card_id" value="<?= $id ?>">
                            <button type="submit" name="start" value="1" class="w-full text-left bg-slate-800 rounded-3xl p-6 border-2 border-slate-700 hover:border-indigo-500 hover:bg-slate-700 transition-all active:scale-95 shadow-xl relative overflow-hidden h-full">
                                <div class="w-full aspect-square mb-4 rounded-2xl overflow-hidden bg-slate-900">
                                    <img src="<?= $card['img'] ?>" alt="<?= $card['name'] ?>" class="card-img group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <h4 class="text-lg font-black mb-2"><?= $card['name'] ?></h4>
                                <div class="space-y-1">
                                    <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                        <span>ATK</span><span><?= $card['atk'] ?></span>
                                    </div>
                                    <div class="flex justify-between text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                        <span>DEF</span><span><?= $card['def'] ?></span>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-slate-700">
                                        <p class="text-[10px] font-bold text-indigo-400 mb-1 uppercase tracking-widest">Special Skill</p>
                                        <p class="text-xs font-bold text-slate-200"><?= $card['skill'] ?></p>
                                    </div>
                                </div>
                            </button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php else: ?>
            <!-- Battle Field -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-in fade-in duration-500">
                
                <div class="space-y-8">
                    <!-- Enemy Card -->
                    <div class="bg-slate-800 rounded-3xl p-6 border-2 border-slate-700 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 opacity-20 -mr-8 -mt-8">
                            <img src="<?= $enemy->getImage() ?>" alt="" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-[10px] font-bold text-rose-500 uppercase tracking-widest bg-rose-500/10 px-2 py-0.5 rounded">Enemy</span>
                                <h3 class="text-xl font-black mt-1"><?= $enemy->getName() ?></h3>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-slate-400">HP</span>
                                <p class="text-xl font-mono font-bold"><?= $enemyHp ?> / 100</p>
                            </div>
                        </div>
                        <div class="w-full bg-slate-900 h-3 rounded-full overflow-hidden border border-slate-700">
                            <div class="hp-bar bg-rose-500 h-full" style="width: <?= $enemyHp ?>%"></div>
                        </div>
                    </div>

                    <div class="flex justify-center py-2 text-slate-700 font-black italic tracking-widest">VS</div>

                    <!-- Player Card -->
                    <div class="bg-slate-800 rounded-3xl p-6 border-2 border-indigo-500 shadow-2xl shadow-indigo-500/10 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 opacity-20 -mr-8 -mt-8">
                            <img src="<?= $player->getImage() ?>" alt="" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="text-[10px] font-bold text-indigo-400 uppercase tracking-widest bg-indigo-500/10 px-2 py-0.5 rounded">Player</span>
                                <h3 class="text-xl font-black mt-1"><?= $player->getName() ?></h3>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-slate-400">HP</span>
                                <p class="text-xl font-mono font-bold"><?= $playerHp ?> / 100</p>
                            </div>
                        </div>
                        <div class="w-full bg-slate-900 h-3 rounded-full overflow-hidden border border-slate-700">
                            <div class="hp-bar bg-emerald-500 h-full" style="width: <?= $playerHp ?>%"></div>
                        </div>

                        <!-- Actions -->
                        <?php if (!$isGameOver): ?>
                            <form action="card_action.php" method="post" class="mt-8 grid grid-cols-2 gap-4">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <button type="submit" name="action" value="attack" class="bg-slate-700 hover:bg-slate-600 py-4 rounded-2xl font-bold transition-all active:scale-95 border border-slate-600">
                                    ⚔️ 通常攻撃
                                </button>
                                <button type="submit" name="action" value="skill" class="bg-indigo-600 hover:bg-indigo-500 py-4 rounded-2xl font-bold transition-all active:scale-95 border border-indigo-400">
                                    ✨ スキル
                                </button>
                            </form>
                        <?php else: ?>
                            <form action="card_action.php" method="post" class="mt-8">
                                <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                <button type="submit" name="reset" value="1" class="w-full bg-rose-600 hover:bg-rose-500 py-4 rounded-2xl font-bold transition-all active:scale-95 shadow-lg shadow-rose-900/20">
                                    🔄 もう一度対戦する
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Battle Logs -->
                <div class="flex flex-col h-full">
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-[0.3em] mb-4 ml-2">Battle Records</h3>
                    <div class="log-container flex-1 bg-slate-950 rounded-3xl border border-slate-800 p-6 overflow-y-auto max-h-[500px] shadow-inner font-mono text-sm space-y-4">
                        <?php foreach (array_reverse($logs) as $log): ?>
                            <div class="flex gap-3 animate-in fade-in slide-in-from-left-2">
                                <span class="text-slate-700 shrink-0">#</span>
                                <p class="<?= str_contains($log, '勝利') || str_contains($log, 'スキル') ? 'text-indigo-400 font-bold' : (str_contains($log, 'ダメージを受けた') ? 'text-rose-400' : 'text-slate-400') ?>">
                                    <?= $log ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </main>
</body>
</html>

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
                            <h3 class="text-2xl font-game font-black mt-2 text-white"><?= $enemy->name ?></h3>
                        </div>
                        <div class="flex items-end justify-end gap-4 mb-2">
                            <div class="text-right">
                                <span class="text-[10px] font-game text-rose-500 block mb-1 tracking-widest">MP: <?= $enemy->mp ?> / <?= $enemy->maxMp ?></span>
                            </div>
                            <p class="text-3xl font-game font-black text-rose-500"><?= $enemy->hp ?><span class="text-lg text-slate-600 ml-1">/<?= $enemy->maxHp ?></span></p>
                        </div>
                        <div class="w-full bg-slate-900 h-4 rounded-full overflow-hidden border border-slate-800 p-0.5">
                            <div class="hp-bar bg-gradient-to-r from-rose-600 to-rose-400 h-full rounded-full transition-all duration-500" style="width: <?= UI::getPercentage($enemy->hp, $enemy->maxHp) ?>%"></div>
                        </div>
                    </div>
                    <div class="w-48 shrink-0 order-1 md:order-2">
                        <div class="tcg-card enemy-card rounded-2xl p-2 rotate-2 hover:rotate-0 transition-all duration-300">
                            <div class="card-image-frame aspect-[3/4] rounded-xl overflow-hidden bg-black">
                                <img src="<?= $enemy->image ?>" class="w-full h-full object-cover opacity-80">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Versus Divider -->
                <div class="relative flex items-center py-4">
                    <div class="flex-grow border-t border-slate-800/50"></div>
                    <span class="flex-none mx-4 px-6 py-2 rounded-full border border-slate-800 bg-slate-950 font-game font-black italic text-slate-700 text-xl tracking-widest">VS</span>
                    <div class="flex-grow border-t border-slate-800/50"></div>
                </div>

                <!-- Player Side -->
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                    <div class="w-48 shrink-0">
                        <div class="tcg-card player-card rounded-2xl p-2 -rotate-2 hover:rotate-0 transition-all duration-300">
                            <div class="card-image-frame aspect-[3/4] rounded-xl overflow-hidden bg-black">
                                <img src="<?= $player->image ?>" class="w-full h-full object-cover opacity-90">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 w-full max-w-md">
                        <div class="mb-2">
                            <span class="text-[10px] font-game font-bold text-indigo-400 uppercase tracking-[0.3em] bg-indigo-500/10 px-3 py-1 rounded-full border border-indigo-500/20">Active Unit</span>
                            <h3 class="text-2xl font-game font-black mt-2 text-white"><?= $player->name ?></h3>
                        </div>
                        <div class="flex items-end gap-4 mb-2">
                            <p class="text-3xl font-game font-black text-emerald-400"><?= $player->hp ?><span class="text-lg text-slate-600 ml-1">/<?= $player->maxHp ?></span></p>
                            <div>
                                <span class="text-[10px] font-game text-indigo-400 block mb-1 tracking-widest text-right">MP: <?= $player->mp ?> / <?= $player->maxMp ?></span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-900 h-4 rounded-full overflow-hidden border border-slate-800 p-0.5 shadow-inner">
                            <div class="hp-bar bg-gradient-to-r from-emerald-600 to-emerald-400 h-full rounded-full transition-all duration-500" style="width: <?= UI::getPercentage($player->hp, $player->maxHp) ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Battle Logs Section -->
            <div class="lg:col-span-4 sticky top-4">

                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-game font-black text-slate-400 uppercase tracking-[0.4em]">Battle Feed</h3>
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                </div>

                <!-- Actions -->
                <div class="mb-6">
                    <?php if (!$isGameOver): ?>
                        <form action="action.php" method="post" class="mt-2 grid grid-cols-2 gap-4">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <button type="submit" name="action" value="attack" class="bg-slate-800 hover:bg-slate-700 py-4 rounded-xl font-game font-bold transition-all border border-slate-700 flex flex-col items-center group active:scale-95">
                                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">⚔️</span>
                                <span class="text-[10px] tracking-widest text-slate-400 uppercase">Attack</span>
                            </button>
                            <button type="submit" name="action" value="skill" <?= $player->mp <= 0 ? 'disabled' : '' ?> class="bg-slate-800 hover:bg-slate-700 disabled:opacity-30 py-4 rounded-xl font-game font-bold transition-all border border-slate-700 flex flex-col items-center group shadow-lg active:scale-95">
                                <span class="text-xl mb-1 group-hover:animate-pulse">✨</span>
                                <span class="text-[10px] tracking-widest text-slate-400 uppercase">Skill</span>
                            </button>
                        </form>
                    <?php else: ?>
                        <form action="action.php" method="post" class="mt-4">
                            <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                            <button type="submit" name="reset" value="1" class="w-full bg-slate-100 hover:bg-white text-slate-950 py-5 rounded-xl font-game font-black transition-all flex items-center justify-center gap-3 shadow-xl active:scale-95">
                                <span class="text-xl">🔄</span> RE-INITIALIZE SYSTEM
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="bg-slate-900/50 rounded-3xl border border-slate-800 p-6 h-[550px] overflow-y-auto font-mono text-[13px] space-y-4 shadow-inner custom-scrollbar">
                    <?php foreach (array_reverse($logs) as $log): ?>
                        <div class="log-entry animate-in slide-in-from-left duration-300">
                            <p class="leading-relaxed <?= str_contains($log, '勝利') ? 'text-yellow-400 font-bold' : (str_contains($log, '力尽きた') ? 'text-rose-500 font-bold' : 'text-slate-300') ?>">
                                <?= nl2br(htmlspecialchars($log)) ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
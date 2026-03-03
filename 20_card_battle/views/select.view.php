<!DOCTYPE html>
<html lang="ja">

<?php include VIEW_DIR . 'components/head.view.php'; ?>

<body class="bg-slate-400 text-slate-100 min-h-screen">
    <main class="max-w-5xl mx-auto px-4 py-10">
        <section class="animate-in fade-in zoom-in duration-700">
            <div class="text-center mb-6">
                <h3 class="text-4xl font-game font-black text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-cyan-400 tracking-[0.2em] uppercase mb-4">Select Your Unit</h3>
                <p class="text-white-500 font-medium tracking-widest uppercase text-sm">バトルを開始するカードを選択してください</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                <?php foreach ($availableCards as $id => $card): ?>
                    <form action="action/" method="post" class="group">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        <input type="hidden" name="card_id" value="<?= $id ?>">
                        <button type="submit" name="start" value="1" class="w-full text-left tcg-card rounded-2xl p-4 hover:-translate-y-4 hover:scale-105 active:scale-95 duration-500 shadow-2xl shadow-black/50">
                            <?php include VIEW_DIR . 'components/card.view.php'; ?>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
</body>

</html>
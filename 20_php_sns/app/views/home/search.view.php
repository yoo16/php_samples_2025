<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <?php include COMPONENT_DIR . 'search_form.php' ?>

        <?php include COMPONENT_DIR . 'tweet_form.php' ?>

        <?php if ($tweets !== null): ?>
            <p class="px-4 py-2 font-bold">
                検索キーワード: <span><?= h($keyword) ?></span>
            </p>
            <p class="px-4 py-2 font-bold">
                <?= count($tweets) ?> 件の投稿が検索されました
            </p>
        <?php endif; ?>

        <?php foreach ($tweets as $value): ?>
            <?php include COMPONENT_DIR . 'tweet.php' ?>
        <?php endforeach ?>
    </main>

</div>

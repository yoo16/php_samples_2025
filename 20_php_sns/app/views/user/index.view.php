<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="sticky top-0 h-screen w-20 shrink-0 self-start border-r border-slate-100 xl:w-56">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <?php include COMPONENT_DIR . 'dashboard.php' ?>
        <?php include COMPONENT_DIR . 'profile_tabs.php' ?>

        <div id="user-tweet-list">
            <?php if (empty($tweets)) : ?>
                <p class="p-8 text-center text-slate-400 text-sm">投稿がありません</p>
            <?php else : ?>
                <?php foreach ($tweets as $tweet) : ?>
                    <?php include COMPONENT_DIR . 'tweet_item.php' ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

</div>

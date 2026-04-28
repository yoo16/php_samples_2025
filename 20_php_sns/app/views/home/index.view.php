<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="sticky top-0 h-screen w-20 shrink-0 self-start border-r border-slate-100 xl:w-56">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <?php $activeTab = $active_tab ?? 'public'; ?>
        <div class="grid grid-cols-2 border-b border-slate-100 sticky top-0 bg-white/95 backdrop-blur z-10">
            <a href="<?= BASE_URL ?>home/?tab=public"
                class="px-4 py-3 text-center text-sm font-semibold transition <?= $activeTab === 'public' ? 'border-b-2 border-sky-500 text-slate-900' : 'text-slate-500 hover:bg-slate-50' ?>">
                パブリック
            </a>
            <a href="<?= BASE_URL ?>home/?tab=followers"
                class="px-4 py-3 text-center text-sm font-semibold transition <?= $activeTab === 'followers' ? 'border-b-2 border-sky-500 text-slate-900' : 'text-slate-500 hover:bg-slate-50' ?>">
                フォロワー
            </a>
        </div>

        <!-- 検索バー（sticky） -->
        <?php include COMPONENT_DIR . 'search_form.php' ?>

        <!-- ツイート投稿フォーム -->
        <?php include COMPONENT_DIR . 'tweet_form.php' ?>

        <div id="tweet-list"
            data-auth-user-id="<?= (int) $auth_user['id'] ?>">
            <?php if (empty($tweets)) : ?>
                <p class="p-8 text-center text-slate-400 text-sm">
                    <?= $activeTab === 'followers' ? 'フォロー中ユーザーの投稿はありません' : '投稿がありません' ?>
                </p>
            <?php else : ?>
                <?php foreach ($tweets as $tweet) : ?>
                    <?php include COMPONENT_DIR . 'tweet_item.php' ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

</div>

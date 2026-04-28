<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
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
            data-auth-user-id="<?= (int) $auth_user['id'] ?>"
            data-initial-count="<?= count($tweets ?? []) ?>"
            data-tab="<?= h($activeTab) ?>">
            <?php if (empty($tweets)) : ?>
                <p class="p-8 text-center text-slate-400 text-sm">
                    <?= $activeTab === 'followers' ? 'フォロワーの投稿はありません' : '投稿がありません' ?>
                </p>
            <?php else : ?>
                <?php foreach ($tweets as $tweet) : ?>
                    <?php include COMPONENT_DIR . 'tweet_item.php' ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <div id="tweet-list-loading" class="p-8 flex justify-center text-slate-400 hidden">
                <svg class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
        </div>
    </main>

</div>
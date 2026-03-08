<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <!-- 検索バー（sticky） -->
        <?php include COMPONENT_DIR . 'search_form.php' ?>

        <!-- ツイート投稿フォーム -->
        <?php include COMPONENT_DIR . 'tweet_form.php' ?>

        <!-- ツイート一覧 -->
        <?php include COMPONENT_DIR . 'tweet_list.php' ?>
    </main>

</div>
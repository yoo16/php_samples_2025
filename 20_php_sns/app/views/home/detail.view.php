<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <div class="p-5 border-b border-slate-100">
            <a href="<?= BASE_URL ?>home/" class="font-bold">&larr; <span class="ml-4">ポスト</span></a>
        </div>

        <?php include COMPONENT_DIR . 'tweet.php' ?>
    </main>

</div>

<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen p-6">
        <h1 class="text-2xl font-bold mb-4">メディア</h1>

        <?php if ($tweets): ?>
            <div class="gap-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4">
                <?php foreach ($tweets as $value): ?>
                    <?php if (\Lib\File::has($value['image_path'])): ?>
                        <div class="overflow-hidden rounded shadow bg-white">
                            <a href="<?= BASE_URL ?>home/detail/?id=<?= $value['id'] ?>">
                                <img src="<?= h($value['image_path']) ?>" alt=""
                                    class="w-full h-48 object-cover hover:scale-105 transition-transform duration-200">
                            </a>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500">画像付きの投稿はまだありません。</p>
        <?php endif; ?>
    </main>

</div>

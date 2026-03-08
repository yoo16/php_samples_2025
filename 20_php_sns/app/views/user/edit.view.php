<div class="flex max-w-4xl mx-auto min-h-screen">

    <!-- サイドナビ -->
    <header class="w-56 shrink-0 sticky top-0 self-start h-screen border-r border-slate-100">
        <?php include COMPONENT_DIR . 'nav.php' ?>
    </header>

    <!-- メインコンテンツ -->
    <main class="flex-1 border-r border-slate-100 min-h-screen">
        <div class="p-5 border-b border-slate-100">
            <a href="<?= BASE_URL ?>user/?id=<?= $auth_user['id'] ?>" class="font-bold">&larr; <span class="ml-4">もどる</span></a>
        </div>
        <div class="w-full mt-3 p-5">
            <h2 class="text-2xl mb-3 font-bold text-center">プロフィールを編集</h2>

            <!-- ユーザ画像 -->
            <?php include COMPONENT_DIR . 'user_upload_image.php' ?>

            <!-- ユーザ編集フォーム -->
            <?php include COMPONENT_DIR . 'user_form.php' ?>
        </div>
    </main>

</div>

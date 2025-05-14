<!DOCTYPE html>
<html lang="ja">

<?php include COMPONENT_DIR . 'head.php' ?>

<body>
    <?php include COMPONENT_DIR . 'loading.php'; ?>

    <?php include COMPONENT_DIR . 'nav.php' ?>

    <main class="container mx-auto py-8">
        <?php include $view_path ?>
    </main>

    <?php include COMPONENT_DIR . 'footer.php' ?>
</body>

</html>
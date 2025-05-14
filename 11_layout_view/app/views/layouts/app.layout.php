<!DOCTYPE html>
<html lang="ja">

<?php include COMPONENT_DIR . 'Head.php' ?>

<body>
    <?php include COMPONENT_DIR . 'Loading.php'; ?>

    <?php include COMPONENT_DIR . 'Nav.php' ?>

    <main class="container mx-auto py-8">
        <?php include $view_path ?>
    </main>

    <?php include COMPONENT_DIR . 'Footer.php' ?>
</body>

</html>
<div>
    <?php if ($tweets): ?>
        <?php foreach ($tweets as $value): ?>
            <?php include COMPONENT_DIR . 'tweet.php' ?>
        <?php endforeach ?>
    <?php endif ?>
</div>
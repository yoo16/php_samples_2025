<?php 
require_once 'models/Item.php';

$item = new Item("コーヒー", 350);
$item->setPrice(-100);
$item->setPrice(400);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品</title>
</head>
<body>
    <h2>商品</h2>
    <h3>商品名</h3>
    <p><?= $item->getName() ?></p>
    <h3>価格</h3>
    <p><?= $item->getPrice() ?>円</p>
</body>
</html>
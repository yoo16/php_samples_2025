<?php 
require_once 'models/Item.php';

$drink1 = new Item("コーヒー", 350);
$drink2 = new Item("紅茶", 400);
$drink3 = new Item("ほうじ茶", 300);
$drink4 = new Item("ほうじ茶", 300);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合計金額</title>
</head>
<body>
    <h2>合計金額</h2>
    <p><?= Item::totalPrice(); ?></p>
</body>
</html>
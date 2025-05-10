<?php 
require_once 'models/Item.php';

$item1 = new Item('コーヒー', 350);
$item1->calculateTax();

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
    
    <table>
        <tr>
            <th>商品名</th>
            <th>価格</th>
            <th>税抜き価格</th>
            <th>税金</th>
        </tr>
        <tr>
            <td><?= $item1->getName() ?></td>
            <td><?= $item1->getPrice() ?>円</td>
            <td><?= $item1->getNoneTaxedPrice() ?>円</td>
            <td><?= $item1->getTax() ?>円</td>
        </tr>
    </table>
</body>
</html>
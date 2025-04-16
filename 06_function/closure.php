<?php

$user = [
    'name' => '東京　太郎',
];

$item = [
    'name' => 'コーヒー',
    'price' => 350,
];

// クロージャーの定義
$greet = function ($name) {
    return "{$name}さん、こんにちは！";
};

// ポイント計算
$point_rate = 0.05;

$point = function ($price) use ($point_rate) {
    $pt = $price * $point_rate;
    return $pt;
};

// 税抜き価格の計算
// 税率
const TAX_RATE = 0.1;

$withoutTaxPrice = fn ($price) => 
    floor($price / (1 + TAX_RATE));
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>メッセージ</h2>
    <p>
        <?= $greet($user['name']) ?>
    </p>

    <h2>商品名</h2>
    <p><?= $item['name'] ?></p>
    <h2>価格</h2>
    <p><?= $item['price'] ?>円</p>
    <h2>税抜き価格</h2>
    <p><?= $withoutTaxPrice($item['price']) ?>円</p>
    <h2>ポイント</h2>
    <p><?= $point($item['price']) ?>pt</p>

</body>

</html>
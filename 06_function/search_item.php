<?php

$user = [
    "id" => 1,
    "name" => "東京　太郎",
    "email" => "tokyo@test.com",
];

$items = [
    [
        "id" => 1,
        "name" => "コーヒー",
        "price" => 350,
        "stock" => 5,
    ],
    [
        "id" => 2,
        "name" => "紅茶",
        "price" => 400,
        "stock" => 5,
    ],
    [
        "id" => 3,
        "name" => "ほうじ茶",
        "price" => 300,
        "stock" => 5,
    ],
];


$greet = function ($name) {
    return "{$name}さん、こんにちは！";
};

$id = 1;
$item_index = array_search($id, array_column($items, "id"));
$item = $items[$item_index];
// var_dump($item);

const POINT_RATE = 0.05;
$point = function ($price) {
    return $price * POINT_RATE;
};

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
</body>

</html>
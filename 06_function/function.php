<?php
// 関数の定義
function greet()
{
    echo "こんにちは";
}

function calculate($x)
{
    $y = $x + 5;
    // 結果を返す
    return $y;
}

function totalPrice($price, $amount)
{
    $total_price = $price * $amount;
    return $total_price;
}

function calculatePoint(int $price, float $rate = 0.1) {
    $point = $price * $rate;
    return $point;
}

$total_price = totalPrice(150, 3);

// デフォルト値
$point1 = calculatePoint($total_price);

// 15%の場合
$point2 = calculatePoint($total_price, 0.15);

// $point3 = calculatePoint("コーヒー", 0.15);

// 関数の実行
// greet();
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
    <p><?= greet() ?></p>
    <h2>計算結果</h2>
    <p><?= calculate(2) ?></p>

    <h2>合計金額</h2>
    <p><?= $total_price ?></p>

    <h2>ポイント</h2>
    <h3>10%の場合</h3>
    <p><?= $point1 ?></p>

    <h3>15%の場合</h3>
    <p><?= $point2 ?></p>

</body>

</html>
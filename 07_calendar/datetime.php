<?php 

date_default_timezone_set('Asia/Tokyo');

$date = new DateTime();
$date->setDate(2022, 3, 10)->setTime(10, 30, 45);
$date_string = $date->format('Y-m-d H:i:s');

$date1 = new DateTime();
$date1->setDate(2022, 3, 10)->setTime(10, 30, 45);
$date_string1 = $date1->format('Y-m-d H:i:s');

$date2 = new DateTime();
$date2->setDate(2022, 3, 10)->setTime(10, 30, 45);
$date2->modify('+1 day');
$date_string2 = $date2->format('Y-m-d H:i:s');

$is_match = ($date1 < $date2);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body></body>
    <h2>日付</h2>
    <p><?= $date_string ?></p>

    <h2>比較</h2>
    <h3>日付1</h3>
    <p><?= $date_string1 ?></p>
    <h3>日付2</h3>
    <p><?= $date_string2 ?></p>
    <h3>比較結果</h3>
    <p><?= $is_match ?></p>
</body>
</html>
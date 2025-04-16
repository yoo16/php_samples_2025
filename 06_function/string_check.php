<?php 

$message1 = "Hello";
$length1 = strlen($message1);

$message2 = "こんにちは";
$length2 = strlen($message2);

$message3 = "こんにちは";
$length3 = mb_strlen($message3);

$message4 = "Hello,Tokyo";
$message4_1 = substr($message4, 0, 5);
$message4_2 = substr($message4, 6);
$message4_3 = substr($message4, -6, 1);

$address = "東京都新宿区新宿";
$address1 = mb_substr($address, 0, 3);
$address2 = mb_substr($address, 3, 3);
$address3 = mb_substr($address, -2);

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
    <h2>strlen()</h2>
    <h3>文字</h3>
    <p><?= $message1 ?></p>
    <h3>長さ</h3>
    <p><?= $length1 ?></p>

    <h3>文字</h3>
    <p><?= $message2 ?></p>
    <h3>長さ</h3>
    <p><?= $length2 ?></p>

    <h2>mb_strlen()</h2>
    <h3>文字</h3>
    <p><?= $message3 ?></p>
    <h3>長さ</h3>
    <p><?= $length3 ?></p>

    <h2>substr()</h2>
    <h3>文字</h3>
    <p><?= $message4 ?></p>
    <h4>最初から5</h4>
    <p><?= $message4_1 ?></p>
    <h4>7バイト目から</h4>
    <p><?= $message4_2 ?></p>
    <h4>最後の6バイト目から1</h4>
    <p><?= $message4_3 ?></p>

    <h2>mb_substr()</h2>
    <h3>文字</h3>
    <p><?= $address ?></p>
    <h4>最初から3文字</h4>
    <p><?= $address1 ?></p>
    <h4>4文字目から3文字</h4>
    <p><?= $address2 ?></p>
    <h4>最後の2文字目からすべて</h4>
    <p><?= $address3 ?></p>
</body>
</html>
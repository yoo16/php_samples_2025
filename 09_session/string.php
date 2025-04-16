<?php 

$value = "Tokyo";
$value = "東京";
$byte = strlen($value);
$length = mb_strlen($value);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文字チェック</title>
</head>
<body>
   <h2>文字</h2> 
   <p><?= $value ?></p>
   <h2>バイト数</h2> 
   <p><?= $byte ?></p>
   <h2>文字数</h2> 
   <p><?= $length ?></p>
</body>
</html>
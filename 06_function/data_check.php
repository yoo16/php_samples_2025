<?php 
$date_string = date('Y-m-d');
// echo $date_string;
// var_dump($date_string);

// データチェック
// $value = null;
// $value = "";
// $value = "こんにちは";
// $value = false;
// $value = 0;
$value;

// if (is_null($value)) {
//     echo "NULLです。";
// }
if (isset($value)) {
    echo "データが設定されています。";
}
if (empty($value)) {
    echo "データが空欄です。";
}
?>
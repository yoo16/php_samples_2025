<?php 
date_default_timezone_set("Asia/Tokyo");
$now_time = time();
// x日後のタイムスタンプ
$day = 7;
$next_time = $now_time + (24 * 60 * 60) * $day;

// 現在の年
$year = date('Y');
// 現在の月
$month = date('m');
// 現在の月の日数
$days = date('t');
// 現在の日付と時刻
$today_string = date('Y/m/d H:i:s');

// x日後
$next_day_time = strtotime('+1 day');
$next_day = date('Y/m/d', $next_day_time);

// xヶ月前
$prev_day_time = strtotime('-3 month');
$prev_day = date('Y/m/d', $prev_day_time);

// x時間後
$next_hour_time = strtotime('+3 hour');
$next_hour = date('Y/m/d H:i:s', $next_hour_time);

// 次の曜日
$next_week_time = strtotime('+1 sunday');
$next_week = date('Y/m/d H:i:s', $next_week_time);
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
    <h2>現在のタイムスタンプ</h2>
    <p><?= $now_time ?></p>
    <h2><?= $day ?>日後のタイムスタンプ</h2>
    <p><?= $next_time ?></p>
    <h2>現在の年</h2>
    <p><?= $year ?></p>
    <h2><?= $month ?>月の日数</h2>
    <p><?= $days ?></p>
    <h2>現在の日付と時刻</h2>
    <p><?= $today_string ?></p>

    <h2>x日後</h2>
    <p><?= $next_day_time ?></p>
    <p><?= $next_day ?></p>

    <h2>xヶ月前</h2>
    <p><?= $prev_day_time ?></p>
    <p><?= $prev_day ?></p>

    <h2>x時間後</h2>
    <p><?= $next_hour_time ?></p>
    <p><?= $next_hour ?></p>

    <h2>次の曜日</h2>
    <p><?= $next_week_time ?></p>
    <p><?= $next_week ?></p>

</body>
</html>
<?php
$year = 2020;
$month = 1;
$day = 1;

$today = new Datetime();
$today->setDate($year, $month, $day);
$end_day = $today->format('t');
$days = range(1, $end_day);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
</head>

<body>
    <h2><?= $year  ?>/<?= $month  ?></h2>
    <?php foreach ($days as $day) :  ?>
        <div>
            <?= $day  ?>
        </div>
    <?php endforeach ?>
</body>

</html>
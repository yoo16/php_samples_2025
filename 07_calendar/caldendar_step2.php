<?php
$year = 2020;
$month = 1;
$day = 1;

$today = new Datetime();
$today->setDate($year, $month, $day);
$end_day = $today->format('t');
$days = range(1, $end_day);

foreach ($days as $day) {
    $date = new Datetime();
    $date->setDate($year, $month, $day);
    $calendar[] = $date;
}
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
    <h2><?= $year ?>/<?= $month  ?></h2>
    <table>
        <?php foreach ($calendar as $date) :  ?>
            <tr>
                <td>
                    <?= number_format($date->format('d')) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>
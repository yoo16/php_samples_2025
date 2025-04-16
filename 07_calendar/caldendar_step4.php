<?php
$year = 2020;
$month = 1;
$day = 1;

$today = new Datetime();
$today->setDate($year, $month, $day);
$end_day = $today->format('t');
$days = range(1, $end_day);

$calendar = array_fill(0, 5, array_fill(0, 7, 0));
$row = 0;
foreach ($days as $day) {
    $date = new Datetime();
    $date->setDate($year, $month, $day);
    $week_number = $date->format('w');
    $calendar[$row][$week_number] = $date;
    if ($week_number == 6) $row++;
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
    <h2><?= $year ?>/<?= $month ?></h2>
    <table>
        <?php foreach ($calendar as $row_date) :  ?>
            <tr>
                <?php foreach ($row_date as $date) :  ?>
                    <td>
                        <?php if (is_object($date)) : ?>
                            <?= number_format($date->format('d')) ?>
                        <?php endif ?>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>
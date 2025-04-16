<?php
// 各列に対応するビンゴ番号の範囲（B:1-15, I:16-30, N:31-45, G:46-60, O:61-75）
$ranges = [
    range(1, 15),
    range(16, 30),
    range(31, 45),
    range(46, 60),
    range(61, 75),
];

$columns = [];
// 列ごとに番号をシャッフルして5つ選ぶ
foreach ($ranges as $range) {
    shuffle($range);
    $columns[] = array_slice($range, 0, 5);
}

// 中央を FREE に置き換え
$columns[2][2] = 'FREE';

// ビンゴカードのラベル
$labels = ['B', 'I', 'N', 'G', 'O'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ビンゴカード</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-50">
    <main class="container mx-auto p-6">
        <h1 class="text-3xl text-center font-bold mb-6">🎯 ビンゴカード</h1>
        <div class="grid grid-cols-5 gap-px max-w-md mx-auto bg-gray-300 text-center text-lg font-bold shadow-md">
            <?php foreach ($labels as $label): ?>
                <div class="bg-blue-500 text-white p-4"><?= $label ?></div>
            <?php endforeach; ?>

            <?php foreach ($columns as $i => $rows): ?>
                <?php foreach ($rows as $j => $value): ?>
                    <?php
                    // $value = $columns[$j][$i];
                    $isFree = ($value === 'FREE');
                    ?>
                    <div class="<?= $isFree ? 'bg-yellow-200' : 'bg-white' ?> p-4 border border-gray-300 hover:bg-green-100 transition">
                        <?= $value ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>
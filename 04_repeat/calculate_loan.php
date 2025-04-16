<?php
// 借入額
$start_loan = 20000000;
// ローン残高
$loan = $start_loan;
// 支払額（月）
$pay_by_month = 80000;
// 利息（年）
$interest_rate = 0.01;
// 利息
$interest = 0;
// 支払い月数
$month = 0;

// ローンデータ初期化
$values = [];
// ローン残高がある場合は繰り返し
while ($loan > 0) {
    $month++;
    $interest = ($loan * $interest_rate) / 12;
    $loan -= ($pay_by_month - $interest);

    $values[] = [
        'month' => $month,
        'interest' => round($interest),
        'loan' => round($loan)
    ];
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ローンシミュレーション</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="container mx-auto p-4">
        <h1 class="text-2xl text-center font-bold p-3">ローンシミュレーション</h1>

        <div class="my-2">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">借入額</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">返済額(月)</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">利息</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">月数</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300 text-left">&yen;<?= number_format($start_loan) ?></td>
                        <td class="px-4 py-2 border border-gray-300 text-left">&yen;<?= number_format($pay_by_month) ?></td>
                        <td class="px-4 py-2 border border-gray-300 text-left"><?= $interest_rate * 100 ?>%</td>
                        <td class="px-4 py-2 border border-gray-300 text-left"><?= $month ?>ヶ月</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="my-2">
            <table class="min-w-full table-auto border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border border-gray-300 text-left">月数</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">利息</th>
                        <th class="px-4 py-2 border border-gray-300 text-left">ローン残高</th>
                    </tr>
                </thead>
                <?php foreach ($values as $value) : ?>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300"><?= $value['month'] ?></td>
                        <td class="px-4 py-2 border border-gray-300"><?= number_format($value['interest']) ?></td>
                        <td class="px-4 py-2 border border-gray-300"><?= number_format($value['loan']) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </main>
</body>

</html>
<?php
$drinkIndex = 1;

// 商品の配列
$drinks = ["コーラ", "オレンジジュース", "紅茶"];

// 価格の配列: インデックス指定で追加更新
$prices = [];
$prices[0] = 400;
$prices[1] = 500;
$prices[2] = 450;

// 画像の配列: 追加
$images[] = "images/cola.webp";
$images[] = "images/orange.webp";
$images[] = "images/tea.webp";

// ドリンク選択
$drink = $drinks[$drinkIndex];
$price = $prices[$drinkIndex];
$image = $images[$drinkIndex];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配列</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="container mx-auto p-4">
        <h1 class="text-2xl text-center font-bold p-3">オーダー選択</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="border border-gray-200 rounded overflow-hidden">
                <img src="<?= $image; ?>" class="w-full object-cover">
                <div class="p-4">
                    <h2 class="font-bold mb-2"><?= $drink; ?></h2>
                    <p>&yen;<?= $price; ?></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
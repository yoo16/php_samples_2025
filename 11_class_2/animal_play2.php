<?php 
require_once "models/Cat.php";
require_once "models/Dog.php";

$cat1 = new Cat("アリス");
$cat2 = new Cat("ミケ");

$dog1 = new Dog("タロー");
$dog2 = new Dog("ボブ");

// 多様性（ポリモーフィズム）
$animals = [
    $cat1, $cat2,
    $dog1, $dog2,
];
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
    <?php foreach ($animals as $animal): ?>
        <p>
            <?php $animal->cry() ?>
            <?php $animal->run() ?>
        </p>
    <?php endforeach ?>

    <h2>お手</h2>
    <p>
        <?php $dog1->pawAndEat("ビーフジャーキー"); ?>
    </p>

    <h2>食べる</h2>
    <p>
        <?php $dog1->eat("ビーフジャーキー"); ?>
    </p>
</body>
</html>
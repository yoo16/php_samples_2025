<?php 
// require_once "./models/Animal.php";

// // インスタンス生成
// $dog = new Animal();
// $dog->type = "dog";
// $dog->name = "タロー";
// $dog->crying = "わん！";

// $dog->run();
// $dog->eat("ビーフジャーキー");

require_once "models/Cat.php";
require_once "models/Dog.php";

// サブクラスインスタンス
$cat = new Cat("アリス");
$cat->cry();
$cat->run();

$dog = new Dog("タロー");
$dog->cry();
$dog->run();
?>
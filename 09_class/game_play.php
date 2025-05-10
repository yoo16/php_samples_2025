<?php 
require_once 'models/Cat.php';
require_once 'models/Dog.php';

$cat = new Cat('アリス');
$dog = new Dog('タロー');

$dog->greet($cat);
?>
<?php
require_once '../app.php';

// データの準備
$user = new User();
$user->name = "山田太郎";
$user->age = 25;
$user->profile_image = "images/profile.png";
$user->introduction = "こんにちは、山田太郎です。\n趣味はプログラミングと旅行です。";

// データのバインド
$data = [
    'user' => $user,
];

// View でレンダリング
View::render('profile/index', $data);

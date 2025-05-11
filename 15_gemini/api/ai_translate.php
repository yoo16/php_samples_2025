<?php
require_once '../service/Gemini.php';
require_once '../lib/Lang.php';

// CORS設定
header("Access-Control-Allow-Origin: *"); // 必要に応じて "*" を特定のオリジンに変更
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

// PHPでPOSTリクエストからデータを受け取る
$posts = json_decode(file_get_contents('php://input'), true);

// origin, fromLang, toLangの値の検証
if (!isset($posts['origin']) || !isset($posts['fromLang']) || !isset($posts['toLang'])) {
    $data = [
        'status' => 'error',
        'message' => 'Invalid input data'
    ];
    echo json_encode($data);
    exit;
}

// 翻訳
$gemini = new Gemini();
$posts['translate']  = $gemini->translate($posts['origin'], $posts['fromLang'], $posts['toLang']);

// テストデータの場合
// $posts['translate'] = "Hello";

// JSON形式でレスポンス
$json = json_encode($posts);
echo $json;
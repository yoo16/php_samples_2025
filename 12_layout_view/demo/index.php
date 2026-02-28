<?php
require_once '../app.php';

// データの準備
$data = [
    'title' => 'Demoページ',
    'message' => 'このデータは、Viewファイルに渡して表示しました。',
];

View::render('demo/index', $data);
?>
<?php

require_once '../setting.php';
require_once '../lib/functions.php';

init();
checkPostRequest();

// カラム
const USER_COLUMNS = ['name', 'email', 'password'];

function initUser()
{
    // ファイルがなければカラム追加
    if (!file_exists(USER_CSV)) {
        $file = fopen(USER_CSV, 'w');
        fputcsv($file, USER_COLUMNS);
        fclose($file);
    }
}

function save(array $data)
{
    // 書き込みデータ生成
    foreach (USER_COLUMNS as $column) {
        // データにカラムがあれば
        if (array_key_exists($column, $data)) {
            $posts[] = $data[$column];
        } else {
            $posts[] = '';
        }
    }
    // ファイル保存
    $file = fopen(USER_CSV, 'a+');
    fputcsv($file, $posts);
    fclose($file);
}

initUser();

if (isset($_SESSION['member'])) {
    save($_SESSION['member']);
}

// リダイレクト
header('Location: result.php');
exit;
?>
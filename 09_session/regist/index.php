<?php
session_start();
session_regenerate_id(true);

if (isset($_SESSION['member'])) {
    unset($_SESSION['member']);
}
if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

// 入力画面にリダイレクト
header('Location: input.php');
?>

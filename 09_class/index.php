<?php
require_once 'app.php';

// バトル中でなければ選択画面へ
if (isset($_SESSION['game_data'])) {
    unset($_SESSION['game_data']);
}

header('Location: select.php');
exit;

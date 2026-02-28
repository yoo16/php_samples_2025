<?php
require_once 'models/CardGame.php';

session_start();

$game = new CardGame();

// CSRFトークンの検証
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$game->validateCsrfToken($_POST['csrf_token'] ?? null)) {
    die('不正なリクエストです（CSRFトークン不一致）');
}

$redirectTarget = 'battle.php';

// アクションに応じた処理の実行
if (isset($_POST['start'])) {
    $game->init($_POST['card_id']);
    $redirectTarget = 'battle.php';
} elseif (isset($_POST['reset'])) {
    unset($_SESSION['game_data']);
    $redirectTarget = 'select.php';
} elseif (isset($_POST['action'])) {
    $game->processAction($_POST['action']);
    $redirectTarget = 'battle.php';
}

header('Location: ' . $redirectTarget);
exit;

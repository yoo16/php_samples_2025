<?php
require_once 'models/CardGame.php';

session_start();

// 1. CSRFトークンの検証
if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['csrf_token']) ||
    $_POST['csrf_token'] !== $_SESSION['csrf_token']
) {
    die('不正なリクエストです（CSRFトークン不一致）');
}

$game = new CardGame();

// 2. アクションに応じた処理の実行
if (isset($_POST['start'])) {
    // ゲーム開始（カード選択）
    $game->init($_POST['card_id']);
} elseif (isset($_POST['reset'])) {
    // ゲームリセット
    unset($_SESSION['game_data']);
} elseif (isset($_POST['action'])) {
    // 攻撃・スキル実行
    $game->processAction($_POST['action']);
}

// 3. 元の画面へリダイレクト (PRGパターン：二重送信防止)
header('Location: card_battle.php');
exit;

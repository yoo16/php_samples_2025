<?php
class GameController extends Controller
{

    public function __construct() {}

    public function index()
    {
        // バトル中でなければ選択画面へ
        if (isset($_SESSION['game_data'])) {
            unset($_SESSION['game_data']);
        }
        header('Location: select.php');
        exit;
    }

    public function select()
    {
        $game = new CardGame();

        // すでにバトル中ならバトル画面へ
        if (isset($_SESSION['game_data'])) {
            header('Location: battle.php');
            exit;
        }
        $csrf_token = $game->getCsrfToken();
        $availableCards = CardGame::getAvailableCards();
        $this->render('select.view.php', [
            'csrf_token' => $csrf_token,
            'availableCards' => $availableCards,
        ]);
    }

    public function battle()
    {
        // バトル中でなければ選択画面へ
        if (!isset($_SESSION['game_data'])) {
            header('Location: select.php');
            exit;
        }

        $game = new CardGame();
        $csrf_token = $game->getCsrfToken();

        $player = $game->getPlayer();
        $enemy = $game->getEnemy();
        $logs = $game->getLogs();
        $isGameOver = $game->isGameOver();

        $this->render('battle.view.php', [
            'csrf_token' => $csrf_token,
            'player' => $player,
            'enemy' => $enemy,
            'logs' => $logs,
            'isGameOver' => $isGameOver,
        ]);
    }

    public function action()
    {
        $game = new CardGame();

        // CSRFトークンの検証
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$game->validateCsrfToken($_POST['csrf_token'] ?? null)) {
            die('不正なリクエストです（CSRFトークン不一致）');
        }

        // リダイレクト先
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
    }
}

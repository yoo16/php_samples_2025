<?php
require_once 'KnightCard.php';
require_once 'AquaCard.php';
require_once 'ForestCard.php';
require_once 'ThunderCard.php';

class CardGame
{
    private BaseCard $player;
    private BaseCard $enemy;
    private int $playerHp;
    private int $enemyHp;
    private array $logs;
    private bool $gameOver;

    private static array $cardMap = [
        'knight' => KnightCard::class,
        'aqua'   => AquaCard::class,
        'forest' => ForestCard::class,
        'thunder'=> ThunderCard::class,
    ];

    public function __construct()
    {
        if (isset($_SESSION['game_data'])) {
            $data = $_SESSION['game_data'];
            $this->player = $data['player'];
            $this->enemy = $data['enemy'];
            $this->playerHp = $data['player_hp'];
            $this->enemyHp = $data['enemy_hp'];
            $this->logs = $data['logs'];
            $this->gameOver = $data['game_over'];
        }
    }

    public static function getAvailableCards(): array
    {
        $cards = [];
        foreach (self::$cardMap as $id => $className) {
            $card = new $className();
            $cards[$id] = [
                'name' => $card->getName(),
                'atk' => $card->getAttackPower(),
                'def' => $card->getDefensePower(),
                'elem' => $card->getElement(),
                'img' => $card->getImage(),
                'skill' => $card->getSpecialSkill(),
            ];
        }
        return $cards;
    }

    public function init(string $cardId = 'knight'): void
    {
        $pClass = self::$cardMap[$cardId] ?? KnightCard::class;
        $this->player = new $pClass();
        
        $enemyId = array_rand(self::$cardMap);
        $eClass = self::$cardMap[$enemyId];
        $this->enemy = new $eClass();
        
        $this->playerHp = 100;
        $this->enemyHp = 100;
        $this->logs = ["あなたの相棒：{$this->player->getName()}！ バトル開始！"];
        $this->gameOver = false;
        $this->save();
    }

    public function processAction(string $action): void
    {
        if ($this->gameOver) return;
        $this->executePlayerTurn($action);
        if ($this->enemyHp <= 0) {
            $this->enemyHp = 0;
            $this->logs[] = "敵を倒した！ あなたの勝利です！";
            $this->gameOver = true;
        } else {
            $this->executeEnemyTurn();
            if ($this->playerHp <= 0) {
                $this->playerHp = 0;
                $this->logs[] = "あなたは力尽きた... GAME OVER";
                $this->gameOver = true;
            }
        }
        $this->save();
    }

    private function executePlayerTurn(string $action): void
    {
        $log = "";
        if ($action === 'attack') {
            $dmg = $this->player->getAttackPower() + rand(-5, 5);
            $this->enemyHp -= $dmg;
            $log = "プレイヤーの攻撃！ 敵に {$dmg} のダメージ！";
        } elseif ($action === 'skill') {
            $dmg = $this->player->useSpecialSkill();
            $this->enemyHp -= $dmg;
            $log = "スキル発動！『{$this->player->getSpecialSkill()}』！ 敵に {$dmg} のダメージ！";
        }
        $this->logs[] = $log;
    }

    private function executeEnemyTurn(): void
    {
        $enemyAction = rand(0, 3) === 0 ? 'skill' : 'attack';
        if ($enemyAction === 'skill') {
            $dmg = $this->enemy->useSpecialSkill();
            $this->playerHp -= $dmg;
            $log = "敵のスキル！『{$this->enemy->getSpecialSkill()}』！ あなたは {$dmg} のダメージを受けた！";
        } else {
            $dmg = $this->enemy->getAttackPower() + rand(-3, 3);
            $this->playerHp -= $dmg;
            $log = "敵の攻撃！ あなたは {$dmg} のダメージを受けた！";
        }
        $this->logs[] = $log;
    }

    private function save(): void
    {
        $_SESSION['game_data'] = [
            'player' => $this->player,
            'enemy' => $this->enemy,
            'player_hp' => $this->playerHp,
            'enemy_hp' => $this->enemyHp,
            'logs' => $this->logs,
            'game_over' => $this->gameOver
        ];
    }

    public function getPlayer(): BaseCard { return $this->player; }
    public function getEnemy(): BaseCard { return $this->enemy; }
    public function getPlayerHp(): int { return $this->playerHp; }
    public function getEnemyHp(): int { return $this->enemyHp; }
    public function getLogs(): array { return $this->logs; }
    public function isGameOver(): bool { return $this->gameOver; }
}

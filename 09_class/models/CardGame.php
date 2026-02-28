<?php
require_once 'KnightCard.php';
require_once 'AquaCard.php';
require_once 'ForestCard.php';
require_once 'ThunderCard.php';
require_once __DIR__ . '/../interfaces/CardGameInterface.php';

class CardGame implements CardGameInterface
{
    private ?BaseCard $player = null;
    private ?BaseCard $enemy = null;
    private array $logs = [];
    private bool $gameOver = false;

    private static array $cardMap = [
        'knight' => KnightCard::class,
        'aqua'   => AquaCard::class,
        'forest' => ForestCard::class,
        'thunder' => ThunderCard::class,
    ];

    public function __construct()
    {
        if (isset($_SESSION['game_data'])) {
            $data = $_SESSION['game_data'];
            $this->player = $data['player'];
            $this->enemy = $data['enemy'];
            $this->logs = $data['logs'];
            $this->gameOver = $data['game_over'];
        }
    }

    /**
     * CSRFトークンの生成と取得
     */
    public function getCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * CSRFトークンの検証
     */
    public function validateCsrfToken(?string $token): bool
    {
        return !empty($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    public static function getAvailableCards(): array
    {
        $cards = [];
        foreach (self::$cardMap as $id => $className) {
            $cards[$id] = new $className();
        }
        return $cards;
    }

    public function init(string $cardId = 'knight'): void
    {
        $playerClass = self::$cardMap[$cardId];
        $this->player = new $playerClass();

        $enemyClass = self::$cardMap[array_rand(self::$cardMap)];
        $this->enemy = new $enemyClass();
        $this->gameOver = false;

        // ログの初期化
        $log = "{$this->player->name}（あなた） \n vs \n{$this->enemy->name}（敵）！";
        $this->addLog($log);

        // セッションへの保存
        $this->save();
    }

    public function processAction(string $action): void
    {
        if ($this->gameOver) return;

        // プレイヤーのターン
        $this->executePlayerTurn($action);
        if ($this->isWin()) {
            $this->enemy->hp = 0;
            $this->gameOver = true;
            $this->addLog("敵を倒した！\nあなたの勝利です！");
        } else {
            // 敵のターン
            $this->executeEnemyTurn();
            if ($this->isLose()) {
                $this->player->hp = 0;
                $this->gameOver = true;
                $this->addLog("あなたは力尽きた...\nGAME OVER");
            }
        }
        $this->save();
    }

    private function isWin(): bool
    {
        // TODO: 敵のレベル & 相性に応じて上昇値を変更するようにする
        $exp = rand(3, 8);
        $this->player->gainExp($exp);
        return $this->enemy->hp <= 0;
    }

    private function isLose(): bool
    {
        return $this->player->hp <= 0;
    }

    private function addLog(string $log): void
    {
        $this->logs[] = $log;
    }

    private function executePlayerTurn(string $action): void
    {
        if ($action === 'attack') {
            $dmg = $this->player->attack($this->enemy);
            $this->addLog("{$this->player->name} の攻撃！\n敵に {$dmg} のダメージ！");
        } elseif ($action === 'skill') {
            if ($this->player->mp > 0) {
                $dmg = $this->player->specialSkill($this->enemy);
                $this->addLog("スキル発動！『{$this->player->specialSkill}』！\n敵に {$dmg} のダメージ！ (残りMP: {$this->player->mp})");
            } else {
                $this->addLog("MPが足りません！");
            }
        }
    }

    private function executeEnemyTurn(): void
    {
        // 30%の確率でスキル発動
        $useSkill = ($this->enemy->mp > 0 && rand(0, 9) < 3);
        if ($useSkill) {
            if ($this->enemy->mp > 0) {
                $dmg = $this->enemy->specialSkill($this->player);
                $this->addLog("敵のスキル！『{$this->enemy->specialSkill}』！\nあなたは {$dmg} のダメージを受けた！");
            }
        } else {
            $dmg = $this->enemy->attack($this->player);
            $this->addLog("敵の攻撃！\nあなたは {$dmg} のダメージを受けた！");
        }
    }

    private function save(): void
    {
        $_SESSION['game_data'] = [
            'player' => $this->player,
            'enemy' => $this->enemy,
            'logs' => $this->logs,
            'game_over' => $this->gameOver
        ];
    }

    public function getPlayer(): ?BaseCard
    {
        return $this->player;
    }
    public function getEnemy(): ?BaseCard
    {
        return $this->enemy;
    }
    public function getLogs(): array
    {
        return $this->logs;
    }
    public function isGameOver(): bool
    {
        return $this->gameOver;
    }
}

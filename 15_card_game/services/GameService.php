<?php
require_once __DIR__ . '/../models/AquaCard.php';
require_once __DIR__ . '/../models/ForestCard.php';
require_once __DIR__ . '/../models/KnightCard.php';
require_once __DIR__ . '/../models/ThunderCard.php';

class GameService
{
    public ?BaseCard $player = null;
    public ?BaseCard $enemy = null;
    public string $message = "アクションを選択してください。";

    // コンストラクタ
    public function __construct()
    {
        // セッションからプレイヤーカードを設定
        if (isset($_SESSION['player_card'])) {
            $this->player = $_SESSION['player_card'];
        }
        // セッションから敵カードを設定
        if (isset($_SESSION['enemy_card'])) {
            $this->enemy = $_SESSION['enemy_card'];
        }
    }

    /**
     * プレイヤーカードの設定
     * カードIDでマッチ式でカードを設定
     */
    public function setupPlayer(string $cardId): void
    {
        // カードIDでクラスを判別し、プレイヤーカードを設定
        $this->player = match ($cardId) {
            'aqua'    => new AquaCard(),
            'knight'  => new KnightCard(),
            'forest'  => new ForestCard(),
            'thunder' => new ThunderCard(),
            default   => $this->player,
        };
        // セッションに保存
        $_SESSION['player_card'] = $this->player;
    }

    /**
     * 敵カードの設定
     */
    public function setupEnemy(): void
    {
        // 敵カードが未設定の場合、ランダムに設定
        if (!$this->enemy) {
            $enemy_cards = [
                new AquaCard(),
                new ForestCard(),
                new KnightCard(),
                new ThunderCard()
            ];
            // ランダムに敵カードを選択
            $this->enemy = $enemy_cards[array_rand($enemy_cards)];
            // セッションに保存
            $_SESSION['enemy_card'] = $this->enemy;
        }
    }

    /**
     * アクションの実行
     */
    public function handleAction(string $action): void
    {
        // プレイヤーまたはエネミーが存在しない場合
        if (!$this->player || !$this->enemy) {
            $this->message = "バトルを開始できません。";
            return;
        }

        // 勝利判定
        if ($this->isWin()) {
            $this->message = "{$this->player->name} の勝利です！";
            return;
        }

        // ゲームオーバー判定
        if ($this->isGameOver()) {
            $this->message = "{$this->player->name} は倒れた... 敗北。";
            return;
        }

        // アクションの実行
        $this->message = match ($action) {
            'attack'   => $this->attack(),
            'special'  => $this->special(),
            'level_up' => $this->levelUpPlayer(),
            default    => $this->message,
        };

        // セッションを同期
        $this->syncSession();
    }

    /**
     * 勝利判定
     */
    public function isWin(): bool
    {
        return $this->enemy->hp <= 0;
    }

    /**
     * ゲームオーバー判定
     */
    public function isGameOver(): bool
    {
        return $this->player->hp <= 0;
    }

    /**
     * 攻撃
     */
    private function attack(): string
    {
        // Player の攻撃
        $dmg = $this->player->attack($this->enemy);
        // メッセージの作成
        $message = "{$this->player->name} の攻撃！\n{$this->enemy->name} に {$dmg} のダメージを与えた！";

        // 勝利判定
        if ($this->isWin()) {
            return $this->buildWinMessage($message);
        }

        // 敵のターンを呼び出し、メッセージに追加
        return $message . "\n" . $this->enemyTurn();
    }

    /**
     * 必殺技
     */
    private function special(): string
    {
        // MPが0以上の場合
        if ($this->player->mp > 0) {
            // 必殺技ダメージを計算
            $dmg = $this->player->specialSkill($this->enemy);
            $message = "{$this->player->name} の必殺技「{$this->player->specialSkill}」！\n{$this->enemy->name} に {$dmg} のダメージを与えた！";

            // 勝利判定
            if ($this->isWin()) {
                return $this->buildWinMessage($message);
            }

            return $message . "\n" . $this->enemyTurn();
        }
        return "MPが足りません！";
    }

    /**
     * レベルアップ
     */
    private function levelUpPlayer(): string
    {
        $this->player->levelUp();

        return "{$this->player->name} はレベルアップした！\n"
            . "LV.{$this->player->level} / ATK {$this->player->attack} / DEF {$this->player->defense}";
    }

    /**
     * 勝利時のメッセージ作成
     */
    private function buildWinMessage(string $message): string
    {
        $reward = rand(30, 60);
        $this->player->gainExp($reward);

        return $message . "\n{$this->enemy->name} を倒した！\n{$reward} EXP を獲得！";
    }

    /**
     * 敵のターン
     */
    private function enemyTurn(): string
    {
        $action = ($this->enemy->mp > 0 && rand(0, 1) === 1) ? 'special' : 'attack';

        if ($action === 'special') {
            $dmg = $this->enemy->specialSkill($this->player);
            $message = "{$this->enemy->name} の必殺技「{$this->enemy->specialSkill}」！\n{$this->player->name} は {$dmg} のダメージを受けた！";
        } else {
            $dmg = $this->enemy->attack($this->player);
            $message = "{$this->enemy->name} の攻撃！\n{$this->player->name} は {$dmg} のダメージを受けた！";
        }

        if ($this->isGameOver()) {
            $message .= "\n{$this->player->name} は力尽きた...";
        }

        return $message;
    }

    /**
     * セッションを同期
     */
    private function syncSession(): void
    {
        $_SESSION['player_card'] = $this->player;
        $_SESSION['enemy_card'] = $this->enemy;
    }
}

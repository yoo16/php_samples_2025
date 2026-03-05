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

    public function __construct()
    {
        if (isset($_SESSION['player_card'])) {
            $this->player = $_SESSION['player_card'];
        }
        if (isset($_SESSION['enemy_card'])) {
            $this->enemy = $_SESSION['enemy_card'];
        }
    }

    /**
     * プレイヤーカードの設定
     */
    public function setupPlayer(string $cardId): void
    {
        $this->player = match ($cardId) {
            'aqua'    => new AquaCard(),
            'knight'  => new KnightCard(),
            'forest'  => new ForestCard(),
            'thunder' => new ThunderCard(),
            default   => $this->player,
        };
        $_SESSION['player_card'] = $this->player;
    }

    /**
     * 敵カードの設定
     */
    public function setupEnemy(): void
    {
        if (!$this->enemy) {
            $enemy_cards = [new AquaCard(), new ForestCard(), new KnightCard(), new ThunderCard()];
            $this->enemy = $enemy_cards[array_rand($enemy_cards)];
            $_SESSION['enemy_card'] = $this->enemy;
        }
    }

    /**
     * アクションの実行
     */
    public function handleAction(string $action): void
    {
        $this->message = match ($action) {
            'attack'   => $this->attack(),
            'special'  => $this->special(),
            'gain_exp' => $this->gainExp(),
            'reset'    => $this->reset(),
            default    => $this->message,
        };
    }

    private function attack(): string
    {
        $dmg = $this->player->attack($this->enemy);
        return "{$this->player->name} の攻撃！\n{$this->enemy->name} に {$dmg} のダメージを与えた！";
    }

    private function special(): string
    {
        if ($this->player->mp > 0) {
            $dmg = $this->player->specialSkill($this->enemy);
            return "{$this->player->name} の必殺技「{$this->player->specialSkill}」！\n{$this->enemy->name} に {$dmg} のダメージを与えた！";
        }
        return "MPが足りません！";
    }

    private function gainExp(): string
    {
        $exp = rand(20, 50);
        $this->player->gainExp($exp);
        $msg = "{$this->player->name} は {$exp} の経験値を獲得した！";
        if ($this->player->isLevelUp()) {
            $this->player->levelUp();
            $msg .= "\nレベルアップ！ LV.{$this->player->level} になった！";
        }
        return $msg;
    }

    private function reset(): string
    {
        unset($_SESSION['player_card']);
        unset($_SESSION['enemy_card']);
        header("Location: card_list.php");
        exit;
    }
}

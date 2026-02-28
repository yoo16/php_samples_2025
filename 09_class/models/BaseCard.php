<?php
require_once __DIR__ . '/../interfaces/CardInterface.php';

abstract class BaseCard implements CardInterface
{
    public int $level = 1;
    public string $name = '';
    public int $attack = 0;
    public int $defense = 0;
    public int $hp = 0;
    public int $maxHp = 0;
    public int $mp = 0;
    public int $maxMp = 0;
    public int $exp = 0;
    public string $element = '';
    public string $image = '';
    public string $specialSkill = '';
    public int $specialSkillPower = 0;
    public array $levelUpThresholds = [20, 50, 90, 150, 220, 300, 400, 500, 700, 1000];

    /**
     * 子クラスから送られてきた値でプロパティを初期化する
     */
    public function __construct(
        string $name,
        int $attack,
        int $defense,
        int $hp,
        int $mp,
        string $element,
        string $image,
        string $specialSkill,
        int $specialSkillPower
    ) {
        $this->level = 1;
        $this->exp = 0;
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->hp = $hp;
        $this->maxHp = $hp;
        $this->mp = $mp;
        $this->maxMp = $mp;
        $this->element = $element;

        // 画像パスの処理: URLでなければ ./images/ フォルダを参照する
        if (str_starts_with($image, 'http')) {
            $this->image = $image;
        } else {
            $this->image = './images/' . $image;
        }

        $this->specialSkill = $specialSkill;
        $this->specialSkillPower = $specialSkillPower;
    }

    public function attack(BaseCard $target): int
    {
        // ダメージ計算: (攻撃力 * 1.5 - 相手の防御力) + 乱数
        $baseDmg = ($this->attack * 1.5) - $target->defense;
        $random = rand(-5, 5);
        $dmg = (int)($baseDmg + $random);
        
        // 最低ダメージ保証 (攻撃力の 20%)
        $minDmg = (int)($this->attack * 0.2);
        if ($dmg < $minDmg) $dmg = $minDmg;
        
        $target->hp -= $dmg;
        if ($target->hp < 0) $target->hp = 0;
        
        return $dmg;
    }

    public function specialSkill(BaseCard $target): int
    {
        if ($this->mp <= 0) return 0;
        $this->mp--;
        
        // スキルダメージ: (スキル威力 * 1.2 - 相手の防御力 * 0.5)
        $baseDmg = ($this->specialSkillPower * 1.2) - ($target->defense * 0.5);
        $random = rand(-10, 10);
        $dmg = (int)($baseDmg + $random);
        
        if ($dmg < 0) $dmg = 0;
        $target->hp -= $dmg;
        if ($target->hp < 0) $target->hp = 0;
        
        return $dmg;
    }

    public function gainExp(int $exp): void
    {
        $this->exp += $exp;
    }

    public function isLevelUp(): bool
    {
        if ($this->level >= 10) return false;
        return $this->exp >= $this->levelUpThresholds[$this->level - 1];
    }

    public function levelUp(): void
    {
        $this->level++;
        $this->attack += 5;
        $this->defense += 2;
        $this->maxHp += 20;
        $this->hp = $this->maxHp; // レベルアップで全回復
        $this->maxMp += 1;
        $this->mp = $this->maxMp;
    }
}

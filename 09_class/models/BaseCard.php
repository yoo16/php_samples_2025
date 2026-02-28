<?php
require_once __DIR__ . '/../interfaces/CardInterface.php';

abstract class BaseCard implements CardInterface
{
    public int $level;
    public string $name;
    public int $attack;
    public int $defense;
    public int $hp;
    public int $mp;
    public int $exp;
    public string $element;
    public string $image;
    public string $specialSkill;
    public int $specialSkillPower;
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
        $this->mp = $mp;
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
        $dmg = $this->attack + rand(-3, 3);
        $dmg -= $target->defense;
        if ($dmg < 0) $dmg = 0;
        $target->hp -= $dmg;
        return $dmg;
    }

    public function specialSkill(BaseCard $target): int
    {
        if ($this->mp <= 0) return 0;
        $this->mp--;
        $dmg = $this->specialSkillPower + rand(-5, 5);
        $dmg -= $target->defense;
        if ($dmg < 0) $dmg = 0;
        $target->hp -= $dmg;
        return $dmg;
    }

    public function gainExp(int $exp): void
    {
        $this->exp += $exp;
    }

    public function isLevelUp(): bool
    {
        foreach ($this->levelUpThresholds as $threshold) {
            if ($this->level < 10 && $this->exp >= $threshold) {
                return true;
            }
        }
        return false;
    }

    public function levelUp(): void
    {
        $this->level++;
        // TODO: レベルに応じて上昇値を変更するようにする
        $this->attack += 2;
        $this->defense += 1;
        $this->hp += 5;
        $this->mp += 1;
    }
}

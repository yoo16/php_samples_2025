<?php
require_once 'CardInterface.php';

abstract class BaseCard implements CardInterface
{
    protected string $name;
    protected int $attack;
    protected int $defense;
    protected string $element;
    protected string $image;
    protected string $specialSkill;
    protected int $specialSkillPower;

    /**
     * 子クラスから送られてきた値でプロパティを初期化する
     */
    public function __construct(
        string $name,
        int $attack,
        int $defense,
        string $element,
        string $image,
        string $specialSkill,
        int $specialSkillPower
    ) {
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
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

    public function getName(): string
    {
        return $this->name;
    }
    public function getAttackPower(): int
    {
        return $this->attack;
    }
    public function getDefensePower(): int
    {
        return $this->defense;
    }
    public function getElement(): string
    {
        return $this->element;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getSpecialSkill(): string
    {
        return $this->specialSkill;
    }
    public function useSpecialSkill(): int
    {
        return $this->specialSkillPower;
    }
}

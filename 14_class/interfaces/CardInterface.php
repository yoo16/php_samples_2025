<?php

interface CardInterface
{
    public function attack(BaseCard $target): int;
    public function specialSkill(BaseCard $target): int;
    public function gainExp(int $exp): void;
    public function isLevelUp(): bool;
    public function levelUp(): void;

    // public function getLevel(): int;
    // public function getName(): string;
    // public function getAttackPower(): int;
    // public function getDefensePower(): int;
    // public function getMp(): int;
    // public function getElement(): string;
    // public function getImage(): string;
    // public function getSpecialSkill(): string;
    // public function useSpecialSkill(): int;
}

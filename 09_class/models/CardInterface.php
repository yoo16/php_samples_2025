<?php

interface CardInterface
{
    public function getAttackPower(): int;
    public function getDefensePower(): int;
    public function getSpecialSkill(): string;
    public function useSpecialSkill(): int;
}

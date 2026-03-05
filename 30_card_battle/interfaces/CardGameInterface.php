<?php
interface CardGameInterface
{
    public function init(string $cardId): void;
    public function processAction(string $action): void;
    public function getPlayer(): ?BaseCard;
    public function getEnemy(): ?BaseCard;
    public function getLogs(): array;
    public function isGameOver(): bool;
}

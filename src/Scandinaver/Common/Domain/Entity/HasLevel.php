<?php


namespace Scandinaver\Common\Domain\Entity;

/**
 * Trait HasLevel
 *
 * @package Scandinaver\Common\Domain\Entity
 */
trait HasLevel
{
    protected int $level;

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function isFirst(): bool
    {
        return $this->level === 1;
    }
}
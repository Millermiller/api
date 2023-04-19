<?php

namespace Scandinaver\Learning\Puzzle\Domain\Event;

use Scandinaver\Core\Infrastructure\CrossDomainEvent;

/**
 *
 */
class PuzzleCompletedNotification extends CrossDomainEvent
{

    public function __construct(private readonly int $puzzleId, private readonly int $userId)
    {
    }

    public function getPuzzleId(): string
    {
        return $this->puzzleId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
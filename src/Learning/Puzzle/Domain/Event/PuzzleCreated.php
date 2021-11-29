<?php


namespace Scandinaver\Learning\Puzzle\Domain\Event;

use Scandinaver\Learning\Puzzle\Domain\Entity\Puzzle;
use Scandinaver\Core\Domain\Contract\DomainEvent;

/**
 * Class PuzzleCreatedEvent
 *
 * @package Scandinaver\Puzzle\Domain\Event
 */
class PuzzleCreated implements DomainEvent
{
    private Puzzle $puzzle;

    public function __construct(Puzzle $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function getPuzzle(): Puzzle
    {
        return $this->puzzle;
    }
}
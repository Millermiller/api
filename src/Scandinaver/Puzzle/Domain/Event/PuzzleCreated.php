<?php


namespace Scandinaver\Puzzle\Domain\Event;

use Scandinaver\Puzzle\Domain\Model\Puzzle;
use Scandinaver\Shared\DomainEvent;

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
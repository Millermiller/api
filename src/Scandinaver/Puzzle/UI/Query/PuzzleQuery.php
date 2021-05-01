<?php


namespace Scandinaver\Puzzle\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PuzzleQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Query\PuzzleHandler
 */
class PuzzleQuery implements CommandInterface
{
    private int $puzzle;

    public function __construct(int $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }
}
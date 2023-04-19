<?php


namespace Scandinaver\Learning\Puzzle\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Puzzle\Application\Handler\Query\PuzzleQueryHandler;

/**
 * Class PuzzleQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 */
#[Handler(PuzzleQueryHandler::class)]
class PuzzleQuery implements QueryInterface
{

    public function __construct(private int $puzzle)
    {
    }

    public function getPuzzle(): int
    {
        return $this->puzzle;
    }
}
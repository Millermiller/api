<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\Domain\Contract\Query\PuzzleHandlerInterface;
use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PuzzleHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzleHandler implements PuzzleHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  PuzzleQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
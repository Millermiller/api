<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\Domain\Contract\Query\PuzzleHandlerInterface;
use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class PuzzleHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzleHandler extends AbstractHandler implements PuzzleHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  PuzzleQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 
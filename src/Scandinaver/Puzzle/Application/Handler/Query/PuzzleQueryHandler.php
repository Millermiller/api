<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PuzzleQueryHandler
 *
 * @package Scandinaver\Puzzle\Application\Handler\Query
 */
class PuzzleQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  PuzzleQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
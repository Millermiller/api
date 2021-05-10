<?php


namespace Scandinaver\Puzzle\Application\Handler\Query;

use Scandinaver\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  PuzzleQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
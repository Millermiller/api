<?php


namespace Scandinaver\Learning\Puzzle\Application\Handler\Query;

use Scandinaver\Learning\Puzzle\UI\Query\PuzzleQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

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
     * @param  PuzzleQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
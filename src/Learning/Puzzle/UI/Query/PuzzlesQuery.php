<?php


namespace Scandinaver\Learning\Puzzle\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Learning\Puzzle\Application\Handler\Query\PuzzlesQueryHandler;

/**
 * Class PuzzlesQuery
 *
 * @package Scandinaver\Puzzle\UI\Query
 */
#[Handler(PuzzlesQueryHandler::class)]
class PuzzlesQuery extends FilteringQuery implements QueryInterface
{

}
<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Learning\Translate\Application\Handler\Query\GetTextsQueryHandler;

/**
 * Class GetTextsQuery
 *
 * @package Scandinaver\Learning\Translate\UI\Query
 */
#[Handler(GetTextsQueryHandler::class)]
class GetTextsQuery extends FilteringQuery implements QueryInterface
{

}
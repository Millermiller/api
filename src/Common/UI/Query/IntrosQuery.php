<?php


namespace Scandinaver\Common\UI\Query;

use Scandinaver\Common\Application\Handler\Query\IntrosQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;

/**
 * Class IntrosQuery
 *
 * @package Scandinaver\Common\UI\Query
 */
#[Handler(IntrosQueryHandler::class)]
class IntrosQuery extends FilteringQuery implements QueryInterface
{

}
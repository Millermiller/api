<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;
use Scandinaver\Learning\Asset\Application\Handler\Query\GetCardsQueryHandler;

/**
 * Class GetCardsQuery
 *
 * @package Scandinaver\Learning\Asset\UI\Query
 */
#[Handler(GetCardsQueryHandler::class)]
class GetCardsQuery extends FilteringQuery implements QueryInterface
{

}
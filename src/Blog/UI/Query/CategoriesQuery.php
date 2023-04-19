<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\CategoriesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\FilteringQuery;

/**
 * Class CategoriesQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Handler(CategoriesQueryHandler::class)]
class CategoriesQuery extends FilteringQuery implements QueryInterface
{

}
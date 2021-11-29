<?php


namespace Scandinaver\Blog\UI\Query;

use Scandinaver\Blog\Application\Handler\Query\CategoriesQueryHandler;
use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;

/**
 * Class CategoriesQuery
 *
 * @package Scandinaver\Blog\UI\Query
 */
#[Query(CategoriesQueryHandler::class)]
class CategoriesQuery implements QueryInterface
{

    public function __construct()
    {
    }
}
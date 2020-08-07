<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoriesHandlerInterface;
use Scandinaver\Blog\UI\Query\CategoriesQuery;

/**
 * Class CategoriesHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoriesHandler implements CategoriesHandlerInterface
{

    public function __construct()
    {

    }

    /**
     * @param  CategoriesQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
}
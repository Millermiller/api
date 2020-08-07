<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoryHandlerInterface;
use Scandinaver\Blog\UI\Query\CategoryQuery;

/**
 * Class CategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoryHandler implements CategoryHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  CategoryQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
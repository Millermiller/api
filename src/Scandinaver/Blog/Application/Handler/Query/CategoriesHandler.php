<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoriesHandlerInterface;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoriesQuery;

/**
 * Class CategoriesHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoriesHandler implements CategoriesHandlerInterface
{

    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  CategoriesQuery
     *
     * @return array
     */
    public function handle($query)
    {
        return $this->service->getAll();
    }
}
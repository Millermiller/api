<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoriesHandlerInterface;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  CategoriesQuery|Query $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->service->all();
    }
}
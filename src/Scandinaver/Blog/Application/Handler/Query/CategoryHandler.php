<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoryHandlerInterface;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoryQuery;

/**
 * Class CategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoryHandler implements CategoryHandlerInterface
{

    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CategoryQuery $query
     *
     */
    public function handle($query)
    {
        return $this->service->one($query->getId());
    }
} 
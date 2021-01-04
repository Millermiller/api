<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use Scandinaver\Blog\Domain\Contract\Query\CategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Model\CategoryDTO;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoryQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  CategoryQuery|Query  $query
     *
     * @return CategoryDTO
     * @throws CategoryNotFoundException
     */
    public function handle($query): CategoryDTO
    {
        return $this->service->one($query->getId());
    }
} 
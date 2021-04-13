<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Query\CategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoryQuery;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class CategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoryHandler extends AbstractHandler implements CategoryHandlerInterface
{

    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CategoryQuery|Query  $query
     *
     * @throws CategoryNotFoundException
     */
    public function handle($query): void
    {
        $category = $this->service->one($query->getId());

        $this->resource = new Item($category, new CategoryTransformer());
    }
} 
<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Contract\Query\CategoriesHandlerInterface;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class CategoriesHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoriesHandler extends AbstractHandler implements CategoriesHandlerInterface
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CategoriesQuery|Query  $query
     *
     * @return void
     */
    public function handle($query): void
    {
        $categories = $this->service->all();

        $this->resource = new Collection($categories, new CategoryTransformer());
    }
}
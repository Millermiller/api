<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class CategoriesQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoriesQueryHandler extends AbstractHandler
{

    public function __construct(private CategoryService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CategoriesQuery  $query
     *
     * @return void
     */
    public function handle(BaseCommandInterface $query): void
    {
        $data = $this->service->all($query->getParameters());

        $this->resource = new Collection($data->items(), new CategoryTransformer(), 'category');

        $this->resource->setPaginator(new IlluminatePaginatorAdapter($data));
    }
}
<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Query\CategoryQuery;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class CategoryQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoryQueryHandler extends AbstractHandler
{

    public function __construct(private CategoryService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CategoryQuery $query
     *
     * @throws CategoryNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $category = $this->service->one($query->getId());

        $this->resource = new Item($category, new CategoryTransformer());
    }
} 
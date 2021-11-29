<?php


namespace Scandinaver\Blog\Application\Handler\Query;

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
     * @param  CategoriesQuery  $command
     *
     * @return void
     */
    public function handle(BaseCommandInterface $command): void
    {
        $categories = $this->service->all();

        $this->resource = new Collection($categories, new CategoryTransformer());
    }
}
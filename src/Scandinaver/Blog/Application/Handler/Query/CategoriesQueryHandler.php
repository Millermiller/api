<?php


namespace Scandinaver\Blog\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Query\CategoriesQuery;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CategoriesQueryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Query
 */
class CategoriesQueryHandler extends AbstractHandler
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CategoriesQuery|CommandInterface  $command
     *
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $categories = $this->service->all();

        $this->resource = new Collection($categories, new CategoryTransformer());
    }
}
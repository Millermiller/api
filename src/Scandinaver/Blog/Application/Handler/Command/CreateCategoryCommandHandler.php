<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryDuplicateException;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\CreateCategoryCommand;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class CreateCategoryCommandHandler extends AbstractHandler
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateCategoryCommand|CommandInterface  $command
     *
     * @throws CategoryDuplicateException
     */
    public function handle(CommandInterface $command): void
    {
        $category = $this->service->create($command->getData());

        $this->resource = new Item($category, new CategoryTransformer());
    }
}
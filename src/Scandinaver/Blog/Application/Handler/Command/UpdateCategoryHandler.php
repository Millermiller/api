<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Contract\Command\UpdateCategoryHandlerInterface;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class UpdateCategoryHandler extends AbstractHandler implements UpdateCategoryHandlerInterface
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();

        $this->categoryService = $categoryService;
    }

    /**
     * @param  UpdateCategoryCommand|Command  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle($command): void
    {
        $category = $this->categoryService->update($command->getCategoryId(), $command->getData());

        $this->resource = new Item($category, new CategoryTransformer());
    }
} 
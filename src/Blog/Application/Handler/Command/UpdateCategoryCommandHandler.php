<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\Blog\Domain\Exception\CategoryNotFoundException;
use Scandinaver\Blog\Domain\Service\CategoryService;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;
use Scandinaver\Blog\UI\Resources\CategoryTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class UpdateCategoryCommandHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class UpdateCategoryCommandHandler extends AbstractHandler
{

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();

        $this->categoryService = $categoryService;
    }

    /**
     * @param  UpdateCategoryCommand|BaseCommandInterface  $command
     *
     * @throws CategoryNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $category = $this->categoryService->update($command->getCategoryId(), $command->buildDTO());

        $this->resource = new Item($category, new CategoryTransformer());
    }
} 
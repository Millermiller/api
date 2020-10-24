<?php


namespace Scandinaver\Blog\Application\Handler\Command;

use Scandinaver\Blog\Domain\Contract\Command\UpdateCategoryHandlerInterface;
use Scandinaver\Blog\Domain\Model\CategoryDTO;
use Scandinaver\Blog\Domain\Services\CategoryService;
use Scandinaver\Blog\UI\Command\UpdateCategoryCommand;

/**
 * Class UpdateCategoryHandler
 *
 * @package Scandinaver\Blog\Application\Handler\Command
 */
class UpdateCategoryHandler implements UpdateCategoryHandlerInterface
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param UpdateCategoryCommand $command
     *
     * @return CategoryDTO
     */
    public function handle($command): CategoryDTO
    {
        return $this->categoryService->update($command->getCategoryId(), $command->getData());
    }
} 
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCategoryCommand
 *
 * @see     UpdateCategoryCommandHandler
 * @package Scandinaver\Blog\UI\Command
 */
class UpdateCategoryCommand implements Command
{
    private Category $category;

    private array $data;

    public function __construct(Category $category, array $data)
    {
        $this->category = $category;
        $this->data = $data;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
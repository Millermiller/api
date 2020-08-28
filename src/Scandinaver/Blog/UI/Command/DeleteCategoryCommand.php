<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCategoryCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeleteCategoryHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeleteCategoryCommand implements Command
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
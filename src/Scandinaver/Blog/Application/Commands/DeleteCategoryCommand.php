<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Category;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteCategoryCommand
 * @package Scandinaver\Blog\Application\Commands
 */
class DeleteCategoryCommand implements Command
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}
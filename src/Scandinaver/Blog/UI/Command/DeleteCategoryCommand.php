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
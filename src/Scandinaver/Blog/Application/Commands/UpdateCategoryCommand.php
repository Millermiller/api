<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Blog\Domain\Category;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class UpdateCategoryCommand
 * @package Scandinaver\Blog\Application\Commands
 *
 * @see \Scandinaver\Blog\Application\Handlers\UpdateCategoryHandler
 */
class UpdateCategoryCommand implements Command
{
    /**
     * @var Category
     */
    private $category;

    /**
     * @var array
     */
    private $data;

    public function __construct(Category $category, array $data)
    {
        $this->category = $category;
        $this->data = $data;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
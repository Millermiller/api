<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteCategoryCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeleteCategoryHandler
 * @package Scandinaver\Blog\UI\Command
 */
class DeleteCategoryCommand implements Command
{
    private int $categoryId;

    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
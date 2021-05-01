<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class DeleteCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\DeleteCategoryHandler
 */
class DeleteCategoryCommand implements CommandInterface
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
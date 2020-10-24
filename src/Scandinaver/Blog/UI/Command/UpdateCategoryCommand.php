<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class UpdateCategoryCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdateCategoryHandler
 * @package Scandinaver\Blog\UI\Command
 */
class UpdateCategoryCommand implements Command
{
    private int $categoryId;

    private array $data;

    public function __construct(int $categoryId, array $data)
    {
        $this->categoryId = $categoryId;
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
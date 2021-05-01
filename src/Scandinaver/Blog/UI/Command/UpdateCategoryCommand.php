<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UpdateCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\UpdateCategoryHandler
 */
class UpdateCategoryCommand implements CommandInterface
{
    private int $categoryId;

    private array $data;

    public function __construct(int $categoryId, array $data)
    {
        $this->categoryId = $categoryId;
        $this->data       = $data;
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
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\UpdateCategoryCommandHandler;
use Scandinaver\Blog\Domain\DTO\CategoryDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class UpdateCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Command(UpdateCategoryCommandHandler::class)]
class UpdateCategoryCommand implements CommandInterface
{

    public function __construct(private int $categoryId, private array $data)
    {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function buildDTO(): CategoryDTO
    {
        return CategoryDTO::fromArray($this->data);
    }
}
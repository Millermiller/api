<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\DeleteCategoryCommandHandler;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;

/**
 * Class DeleteCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Command(DeleteCategoryCommandHandler::class)]
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
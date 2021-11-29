<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Blog\Application\Handler\Command\CreateCategoryCommandHandler;
use Scandinaver\Blog\Domain\DTO\CategoryDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreateCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 */
#[Command(CreateCategoryCommandHandler::class)]
class CreateCategoryCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): CategoryDTO
    {
        return CategoryDTO::fromArray($this->data);
    }
}
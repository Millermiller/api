<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     CreateCategoryCommandHandler
 */
class CreateCategoryCommand implements CommandInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
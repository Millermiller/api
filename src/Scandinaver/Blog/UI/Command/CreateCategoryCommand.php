<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCategoryCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     CreateCategoryHandler
 */
class CreateCategoryCommand implements Command
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
<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCategoryCommand
 *
 * @see     CreateCategoryHandler
 * @package Scandinaver\Blog\UI\Command
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
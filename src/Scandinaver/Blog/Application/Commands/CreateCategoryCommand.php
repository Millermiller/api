<?php


namespace Scandinaver\Blog\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateCategoryCommand
 * @package Scandinaver\Blog\Application\Commands
 */
class CreateCategoryCommand implements Command
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
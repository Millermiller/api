<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreatePostCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreatePostHandler
 * @package Scandinaver\Blog\UI\Command
 */
class CreatePostCommand implements Command
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
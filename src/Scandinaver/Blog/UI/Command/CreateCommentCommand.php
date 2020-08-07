<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateCommentCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreateCommentHandler
 * @package Scandinaver\Blog\UI\Command
 */
class CreateCommentCommand implements Command
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
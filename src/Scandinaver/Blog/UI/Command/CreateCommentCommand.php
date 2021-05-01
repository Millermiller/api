<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreateCommentCommand
 *
 * @package Scandinaver\Blog\UI\Command
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreateCommentHandler
 */
class CreateCommentCommand implements CommandInterface
{
    private array $data;

    private UserInterface $user;

    public function __construct(UserInterface $user, array $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
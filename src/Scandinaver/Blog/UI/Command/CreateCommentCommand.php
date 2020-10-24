<?php


namespace Scandinaver\Blog\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateCommentCommand
 *
 * @see     \Scandinaver\Blog\Application\Handler\Command\CreateCommentHandler
 * @package Scandinaver\Blog\UI\Command
 */
class CreateCommentCommand implements Command
{
    private array $data;

    private User $user;

    public function __construct(User $user, array $data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
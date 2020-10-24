<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CompleteTextCommand
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CompleteTextHandler
 * @package Scandinaver\Translate\UI\Command
 */
class CompleteTextCommand implements Command
{
    private User $user;

    private int $text;

    public function __construct(User $user, int $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getText(): int
    {
        return $this->text;
    }
}
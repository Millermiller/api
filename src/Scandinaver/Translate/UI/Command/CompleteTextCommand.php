<?php


namespace Scandinaver\Translate\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\Translate\Domain\Model\Text;
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

    private Text $text;

    public function __construct(User $user, Text $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
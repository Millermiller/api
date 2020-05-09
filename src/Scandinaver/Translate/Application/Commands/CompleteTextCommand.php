<?php


namespace Scandinaver\Translate\Application\Commands;

use Scandinaver\Shared\Contracts\Command;
use Scandinaver\Translate\Domain\Text;
use Scandinaver\User\Domain\User;

/**
 * Class CompleteTextCommand
 *
 * @package Scandinaver\Translate\Application\Commands
 * @see     \Scandinaver\Translate\Application\Handlers\CompleteTextHandler
 */
class CompleteTextCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Text
     */
    private $text;

    /**
     * CompleteTextCommand constructor.
     *
     * @param User $user
     * @param Text $text
     */
    public function __construct(User $user, Text $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Text
     */
    public function getText(): Text
    {
        return $this->text;
    }
}
<?php


namespace Scandinaver\Learning\Translate\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CompleteTextCommand
 *
 * @see     \Scandinaver\Translate\Application\Handler\Command\CompleteTextCommandHandler
 * @package Scandinaver\Translate\UI\Command
 */
class CompleteTextCommand implements CommandInterface
{
    private UserInterface $user;

    private int $text;

    public function __construct(UserInterface $user, int $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getText(): int
    {
        return $this->text;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
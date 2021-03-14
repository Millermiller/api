<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteFavouriteCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteFavouriteHandler
 */
class DeleteFavouriteCommand implements Command
{
    private User $user;

    private int $card;

    public function __construct(User $user, int $card)
    {
        $this->user     = $user;
        $this->card     = $card;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCard(): int
    {
        return $this->card;
    }
}
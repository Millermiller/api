<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeleteFavouriteCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteFavouriteCommandHandler
 */
class DeleteFavouriteCommand implements CommandInterface
{
    private UserInterface $user;

    private int $card;

    public function __construct(UserInterface $user, int $card)
    {
        $this->user = $user;
        $this->card = $card;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
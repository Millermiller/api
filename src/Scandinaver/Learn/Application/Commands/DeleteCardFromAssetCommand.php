<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\User\Domain\User;
use Scandinaver\Learn\Domain\Card;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteCardCommand
 * @package Scandinaver\Learn\Application\Commands
 *
 * @see \Scandinaver\Learn\Application\Handlers\DeleteCardFromAssetHandler
 */
class DeleteCardFromAssetCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Card
     */
    private $card;

    /**
     * CreateFavouriteCommand constructor.
     * @param User $user
     * @param Card $card
     */
    public function __construct(User $user, Card $card)
    {
        $this->user = $user;
        $this->card = $card;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Card
     */
    public function getCard(): Card
    {
        return $this->card;
    }
}
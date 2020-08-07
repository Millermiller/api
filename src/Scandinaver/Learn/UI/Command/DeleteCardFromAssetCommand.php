<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteCardCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteCardFromAssetHandler
 * @package Scandinaver\Learn\UI\Command
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
     *
     * @param  User  $user
     * @param  Card  $card
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
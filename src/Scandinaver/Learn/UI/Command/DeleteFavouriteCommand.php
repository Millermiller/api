<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Card;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteFavouriteCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteFavouriteHandler
 * @package Scandinaver\Learn\UI\Command
 */
class DeleteFavouriteCommand implements Command
{
    private User $user;

    private Language $language;

    private Card $card;

    public function __construct(Language $language, User $user, Card $card)
    {
        $this->language = $language;
        $this->user = $user;
        $this->card = $card;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getCard(): Card
    {
        return $this->card;
    }
}
<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\{Card, Translate, Word};
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateFavouriteCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateFavouriteHandler
 * @package Scandinaver\Learn\UI\Command
 */
class CreateFavouriteCommand implements Command
{
    private User $user;

    private Language $language;

    private Card $card;

    /**
     * CreateFavouriteCommand constructor.
     *
     * @param  Language   $language
     * @param  User       $user
     * @param  Word       $word
     * @param  Translate  $translate
     */
    public function __construct(
        Language $language,
        User $user,
        Card $card
    ) {
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
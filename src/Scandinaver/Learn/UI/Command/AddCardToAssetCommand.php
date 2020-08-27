<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\{Asset, Card, Translate, Word};
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AddCardToAssetCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddCardToAssetHandler
 * @package Scandinaver\Learn\UI\Command
 */
class AddCardToAssetCommand implements Command
{
    private User $user;

    private Asset $asset;

    private Language $language;

    private Card $card;

    /**
     * CreateAssetCommand constructor.
     *
     * @param  User       $user
     * @param  Word       $word
     * @param  Translate  $translate
     * @param  Asset      $asset
     */
    public function __construct(
        User $user,
        Language $language,
        Card $card,
        Asset $asset
    ) {
        $this->user = $user;
        $this->asset = $asset;
        $this->language = $language;
        $this->card = $card;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}
<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Asset;
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
    private User $user;

    private Card $card;

    private Asset $asset;

    /**
     * DeleteCardFromAssetCommand constructor.
     *
     * @param  User   $user
     * @param  Card   $card
     * @param  Asset  $asset
     */
    public function __construct(User $user, Card $card, Asset $asset)
    {
        $this->user = $user;
        $this->card = $card;
        $this->asset = $asset;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCard(): Card
    {
        return $this->card;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }
}
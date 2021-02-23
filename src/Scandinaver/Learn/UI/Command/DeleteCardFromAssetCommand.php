<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class DeleteCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteCardFromAssetHandler
 */
class DeleteCardFromAssetCommand implements Command
{
    private User $user;

    private int $card;

    private int $asset;

    public function __construct(User $user, int $card, int $asset)
    {
        $this->user  = $user;
        $this->card  = $card;
        $this->asset = $asset;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }
}
<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class AddCardToAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddCardToAssetCommandHandler
 */
class AddCardToAssetCommand implements CommandInterface
{
    private UserInterface $user;

    private int $asset;

    private int $card;

    public function __construct(UserInterface $user, int $asset, int $card)
    {
        $this->user  = $user;
        $this->asset = $asset;
        $this->card  = $card;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
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
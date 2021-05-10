<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeleteCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteCardFromAssetCommandHandler
 */
class DeleteCardFromAssetCommand implements CommandInterface
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

    public function getCard(): int
    {
        return $this->card;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
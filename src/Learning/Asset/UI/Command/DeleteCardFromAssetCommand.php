<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\DeleteCardFromAssetCommandHandler;

/**
 * Class DeleteCardCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(DeleteCardFromAssetCommandHandler::class)]
class DeleteCardFromAssetCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private string $asset, private int $card)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function getAsset(): string
    {
        return $this->asset;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
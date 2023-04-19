<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\DeleteAssetCommandHandler;

/**
 * Class DeleteAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(DeleteAssetCommandHandler::class)]
class DeleteAssetCommand implements CommandInterface
{

    public function __construct(private readonly UserInterface $user, private readonly string $asset)
    {
    }

    public function getAsset(): string
    {
        return $this->asset;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
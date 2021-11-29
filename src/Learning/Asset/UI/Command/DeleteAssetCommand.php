<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\DeleteAssetCommandHandler;

/**
 * Class DeleteAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(DeleteAssetCommandHandler::class)]
class DeleteAssetCommand implements CommandInterface
{

    public function __construct(private int $asset)
    {
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
<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class DeleteAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteAssetCommandHandler
 */
class DeleteAssetCommand implements CommandInterface
{

    private int $asset;

    public function __construct(int $asset)
    {
        $this->asset = $asset;
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
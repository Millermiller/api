<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

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
}
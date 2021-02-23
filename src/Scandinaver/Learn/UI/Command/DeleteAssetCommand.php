<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteAssetHandler
 */
class DeleteAssetCommand implements Command
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
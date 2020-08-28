<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\Command;

/**
 * Class DeleteAssetCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\DeleteAssetHandler
 * @package Scandinaver\Learn\UI\Command
 */
class DeleteAssetCommand implements Command
{
    private Asset $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }
}
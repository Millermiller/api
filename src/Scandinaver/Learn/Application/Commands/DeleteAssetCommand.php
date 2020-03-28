<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class DeleteAssetCommand
 * @package Scandinaver\Learn\Application\Commands
 *
 * @see \Scandinaver\Learn\Application\Handlers\DeleteAssetHandler
 */
class DeleteAssetCommand implements Command
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * DeleteAssetCommand constructor.
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }


}
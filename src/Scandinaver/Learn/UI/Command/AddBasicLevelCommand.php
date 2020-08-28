<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class AddBasicLevelCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddBasicLevelHandler
 * @package Scandinaver\Learn\UI\Command
 */
class AddBasicLevelCommand implements Command
{
    private int $assetId;

    public function __construct(array $data)
    {
        $this->assetId = $data['asset_id'];
    }

    public function getAssetId(): int
    {
        return $this->assetId;
    }
}
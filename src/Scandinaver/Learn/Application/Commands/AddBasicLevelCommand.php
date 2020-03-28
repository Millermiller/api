<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\Shared\Contracts\Command;

/**
 * Class AddBasicLevelCommand
 * @package Scandinaver\Learn\Application\Commands
 *
 * @see \Scandinaver\Learn\Application\Handlers\AddBasicLevelHandler
 */
class AddBasicLevelCommand implements Command
{
    /**
     * @var int
     */
    private $asset_id;

    public function __construct(array $data)
    {
        $this->asset_id = $data['asset_id'];
    }

    /**
     * @return int
     */
    public function getAssetId(): int
    {
        return $this->asset_id;
    }
}
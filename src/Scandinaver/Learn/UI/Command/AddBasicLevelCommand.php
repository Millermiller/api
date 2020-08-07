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
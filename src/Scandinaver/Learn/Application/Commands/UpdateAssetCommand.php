<?php


namespace Scandinaver\Learn\Application\Commands;

use Scandinaver\User\Domain\User;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Contracts\Command;

/**
 * Class CreateAssetCommand
 * @package Scandinaver\Learn\Application\Commands
 *
 * @see \Scandinaver\Learn\Application\Handlers\UpdateAssetHandler
 */
class UpdateAssetCommand implements Command
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $data;
    /**
     * @var Asset
     */
    private $asset;

    /**
     * CreateAssetCommand constructor.
     * @param User $user
     * @param Asset $asset
     * @param array $data
     */
    public function __construct(User $user, Asset $asset, array $data)
    {
        $this->user = $user;
        $this->data = $data;
        $this->asset = $asset;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->data['title'];
    }

    public function getLevel()
    {
        return $this->data['level'] ? $this->data['level'] : 0;
    }
}
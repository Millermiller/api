<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;
use Scandinaver\Learn\Domain\Asset;

/**
 * Class CardsOfAssetQuery
 * @package Scandinaver\Learn\Application\Query
 */
class CardsOfAssetQuery implements Query
{
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var User
     */
    private $user;

    /**
     * CardsOfAssetQuery constructor.
     * @param User $user
     * @param Asset $asset
     */
    public function __construct(User $user, Asset $asset)
    {
        $this->asset = $asset;
        $this->user = $user;
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
}
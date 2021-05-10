<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class CardsOfAssetQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\CardsOfAssetQueryHandler
 */
class CardsOfAssetQuery implements QueryInterface
{
    private UserInterface $user;

    private int $asset;

    public function __construct(UserInterface $user, int $asset)
    {
        $this->user  = $user;
        $this->asset = $asset;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }
}
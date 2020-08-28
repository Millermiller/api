<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CardsOfAssetQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\CardsOfAssetHandler
 * @package Scandinaver\Learn\UI\Query
 */
class CardsOfAssetQuery implements Query
{
    private Asset $asset;

    private User $user;

    private Language $language;

    public function __construct(Language $language, User $user, Asset $asset)
    {
        $this->language = $language;
        $this->asset = $asset;
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}
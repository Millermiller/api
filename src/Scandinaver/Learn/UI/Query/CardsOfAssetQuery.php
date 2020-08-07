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
    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Language
     */
    private $language;

    /**
     * CardsOfAssetQuery constructor.
     *
     * @param  Language  $language
     * @param  User      $user
     * @param  Asset     $asset
     */
    public function __construct(Language $language, User $user, Asset $asset)
    {
        $this->language = $language;
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

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}
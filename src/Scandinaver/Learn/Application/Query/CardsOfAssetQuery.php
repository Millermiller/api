<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class CardsOfAssetQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see     \Scandinaver\Learn\Application\Handlers\CardsOfAssetHandler
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
     * @param Language $language
     * @param User     $user
     * @param Asset    $asset
     */
    public function __construct(Language $language, User $user, Asset $asset)
    {
        $this->language = $language;
        $this->asset    = $asset;
        $this->user     = $user;
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
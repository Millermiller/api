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

    private User $user;

    private string $language;

    private int $asset;

    public function __construct(string $language, User $user, int $asset)
    {
        $this->user = $user;
        $this->language = $language;
        $this->asset = $asset;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }
}
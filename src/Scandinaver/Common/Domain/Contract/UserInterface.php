<?php


namespace Scandinaver\Common\Domain\Contract;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Learn\Domain\Model\FavouriteAsset;
use Scandinaver\User\Domain\Contract\Permissions;

/**
 * Interface UserInterface
 *
 * @package Scandinaver\Common\Domain\Contract
 */
interface UserInterface extends Permissions
{

    public function getId(): int;

    public function isPremium(): bool;

    public function getAvatar(): string;

    public function getPersonalAssets(Language $language): array;

    public function addPersonalAsset(Asset $asset): void;

    public function getFavouriteAsset(Language $language): ?FavouriteAsset;
}
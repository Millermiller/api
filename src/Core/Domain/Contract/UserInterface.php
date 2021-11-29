<?php


namespace Scandinaver\Core\Domain\Contract;

use DateTime;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Learning\Asset\Domain\Entity\FavouriteAsset;
use Scandinaver\Core\Domain\Contract\EqualInterface;
use Scandinaver\User\Domain\Contract\Permissions;

/**
 * Interface UserInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface UserInterface extends EqualInterface, Permissions
{

    public function getId(): int;

    public function getAvatar(): string;

    public function getPersonalAssets(Language $language): array;

    public function addPersonalAsset(Asset $asset): void;

    public function getFavouriteAsset(Language $language): ?FavouriteAsset;

    public function setRaisedTo(DateTime $to): void;

    public function getRaisedTo(): DateTime;

    public function isRaising(): bool;
}
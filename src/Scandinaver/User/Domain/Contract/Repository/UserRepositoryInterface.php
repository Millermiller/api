<?php


namespace Scandinaver\User\Domain\Contract\Repository;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;
use Scandinaver\Translate\Domain\Model\Text;
use Scandinaver\User\Domain\Model\{Plan, User};

/**
 * Interface UserRepositoryInterface
 *
 * @package Scandinaver\User\Domain\Contract
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function addAsset(User $user, Asset $asset): void;

    public function addText(User $user, Text $text): void;

    public function setPlan(User $user, Plan $plan): void;

    public function setAvatar(User $user, string $file);

    public function findByNameOrEmail($string): array;
}
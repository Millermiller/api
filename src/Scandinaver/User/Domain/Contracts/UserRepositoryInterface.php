<?php


namespace Scandinaver\User\Domain\Contracts;

use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Contracts\BaseRepositoryInterface;
use Scandinaver\Text\Domain\Text;
use Scandinaver\User\Domain\{Plan, User};

/**
 * Interface UserRepositoryInterface
 *
 * @package Scandinaver\User\Domain\Contracts
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function addAsset(User $user, Asset $asset): void;

    public function addText(User $user, Text $text): void;

    public function setPlan(User $user, Plan $plan): void;

    public function setAvatar(User $user, string $file);

    public function findByNameOrEmail($string): array;
}
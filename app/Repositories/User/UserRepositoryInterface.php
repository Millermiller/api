<?php


namespace App\Repositories\User;

use App\Entities\Plan;
use App\Entities\User;
use App\Repositories\BaseRepositoryInterface;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Text\Domain\Text;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function addAsset(User $user, Asset $asset): void;

    public function addText(User $user, Text $text): void;

    public function setPlan(User $user, Plan $plan): void;

    public function setAvatar(User $user, string $file);

    public function findByNameOrEmail($string): array;
}
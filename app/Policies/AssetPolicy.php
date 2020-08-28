<?php


namespace App\Policies;

use Scandinaver\Learn\Domain\Model\Asset;
use Illuminate\Auth\Access\HandlesAuthorization;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetPolicy
 *
 * @package App\Policies
 */
class AssetPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Asset $asset): bool
    {
        return $user->isAdmin() || $user->hasAsset($asset);
    }

    public function updateResult(User $user, Asset $asset): bool
    {
        return $user->hasAsset($asset);
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Asset $asset): bool
    {
        return $user->isAdmin() || $user->hasAsset($asset);
    }

    public function delete(User $user, Asset $asset): bool
    {
        return $user->isAdmin() || $user->hasAsset($asset);
    }
}

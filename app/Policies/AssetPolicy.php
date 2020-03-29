<?php


namespace App\Policies;

use Scandinaver\Learn\Domain\Asset;
use Illuminate\Auth\Access\HandlesAuthorization;
use Scandinaver\User\Domain\User;

/**
 * Class AssetPolicy
 *
 * @package App\Policies
 */
class AssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the asset.
     *
     * @param User  $user
     * @param Asset $asset
     *
     * @return bool
     */
    public function view(User $user, Asset $asset): bool
    {
        return $user->isAdmin() || $user->hasAsset($asset);
    }

    /**
     * @param User  $user
     * @param Asset $asset
     *
     * @return bool
     */
    public function updateResult(User $user, Asset $asset): bool
    {
        return $user->hasAsset($asset);
    }

    /**
     * Determine whether the user can create assets.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the asset.
     *
     * @param User  $user
     * @param Asset $asset
     *
     * @return bool
     */
    public function update(User $user, Asset $asset): bool
    {
        return $user->hasAsset($asset);
    }

    /**
     * Determine whether the user can delete the asset.
     *
     * @param User  $user
     * @param Asset $asset
     *
     * @return bool
     */
    public function delete(User $user, Asset $asset): bool
    {
        return $user->hasAsset($asset);
    }
}

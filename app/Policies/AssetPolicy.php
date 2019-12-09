<?php

namespace App\Policies;

use App\Entities\{User, Asset};
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the asset.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Asset  $asset
     * @return mixed
     */
    public function view(User $user, Asset $asset)
    {
        return $user->hasAsset($asset);
    }

    /**
     * @param User $user
     * @param Asset $asset
     * @return bool
     */
    public function updateResult(User $user, Asset $asset)
    {
        return $user->hasAsset($asset);
    }

    /**
     * Determine whether the user can create assets.
     *
     * @param  \App\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the asset.
     *
     * @param  \App\Entities\User  $user
     * @param   \App\Entities\Asset  $asset
     * @return mixed
     */
    public function update(User $user, Asset $asset)
    {
        return $user->hasAsset($asset);
    }

    /**
     * Determine whether the user can delete the asset.
     *
     * @param  \App\Entities\User  $user
     * @param   \App\Entities\Asset  $asset
     * @return mixed
     */
    public function delete(User $user, Asset $asset)
    {
        return $user->hasAsset($asset);
    }
}

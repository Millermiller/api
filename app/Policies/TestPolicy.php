<?php

namespace App\Policies;

use App\Entities\Asset;
use Scandinaver\User\Domain\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Asset $asset)
    {
        return true;
    }
}

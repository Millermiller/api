<?php


namespace App\Policies;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\User\Domain\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class TestPolicy
 *
 * @package App\Policies
 */
class TestPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function update(User $user, Asset $asset): bool
    {
        return true;
    }
}

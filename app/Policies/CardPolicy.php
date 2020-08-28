<?php


namespace App\Policies;

use Scandinaver\Learn\Domain\Model\Asset;
use Scandinaver\User\Domain\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Scandinaver\Learn\Domain\Model\Card;

/**
 * Class CardPolicy
 *
 * @package App\Policies
 */
class CardPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Card $card)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Card $card)
    {
        //
    }

    public function delete(User $user, Card $card, Asset $asset): bool
    {
        $isAssetHasCard = $asset->getCards()->contains($card);
        $isUserHasAsset = $user->hasAsset($asset);
        return (($isAssetHasCard && $isUserHasAsset) || $user->isAdmin());
    }

    public function restore(User $user, Card $card)
    {
        //
    }

    public function forceDelete(User $user, Card $card)
    {
        //
    }
}

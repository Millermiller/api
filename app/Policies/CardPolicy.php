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

    /**
     * Determine whether the user can view the card.
     *
     * @param User        $user
     * @param Card  $card
     *
     * @return mixed
     */
    public function view(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can create cards.
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
     * Determine whether the user can update the card.
     *
     * @param User        $user
     * @param Card  $card
     *
     * @return mixed
     */
    public function update(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can delete the card.
     *
     * @param User        $user
     * @param Card  $card
     *
     * @return bool
     */
    public function delete(User $user, Card $card, Asset $asset): bool
    {
        $isAssetHasCard = $asset->getCards()->contains($card);
        $isUserHasAsset = $user->hasAsset($asset);
        return (($isAssetHasCard && $isUserHasAsset) || $user->isAdmin());
    }

    /**
     * Determine whether the user can restore the card.
     *
     * @param User        $user
     * @param Card  $card
     *
     * @return mixed
     */
    public function restore(User $user, Card $card)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the card.
     *
     * @param User        $user
     * @param Card  $card
     *
     * @return mixed
     */
    public function forceDelete(User $user, Card $card)
    {
        //
    }
}

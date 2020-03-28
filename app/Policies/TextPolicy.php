<?php


namespace App\Policies;

use Scandinaver\User\Domain\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Scandinaver\Text\Domain\Text;

/**
 * Class TextPolicy
 *
 * @package App\Policies
 */
class TextPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Text.
     *
     * @param User $user
     * @param Text $text
     *
     * @return bool
     */
    public function view(User $user, Text $text): bool
    {
        return $user->hasText($text);
    }

    /**
     * Determine whether the user can create Texts.
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
     * Determine whether the user can update the Text.
     *
     * @param User $user
     * @param Text $Text
     *
     * @return mixed
     */
    public function update(User $user, Text $Text)
    {
        //
    }

    /**
     * Determine whether the user can delete the Text.
     *
     * @param User $user
     * @param Text $Text
     *
     * @return mixed
     */
    public function delete(User $user, Text $Text)
    {

    }

    /**
     * Determine whether the user can restore the Text.
     *
     * @param User $user
     * @param Text $Text
     *
     * @return mixed
     */
    public function restore(User $user, Text $Text)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the Text.
     *
     * @param User $user
     * @param Text $Text
     *
     * @return mixed
     */
    public function forceDelete(User $user, Text $Text)
    {
        //
    }
}

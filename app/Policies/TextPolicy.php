<?php


namespace App\Policies;

use Scandinaver\User\Domain\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Scandinaver\Translate\Domain\Model\Text;

/**
 * Class TextPolicy
 *
 * @package App\Policies
 */
class TextPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Text $text): bool
    {
        return $user->hasText($text);
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Text $Text)
    {
        //
    }

    public function delete(User $user, Text $Text)
    {

    }

    public function restore(User $user, Text $Text)
    {
        //
    }

    public function forceDelete(User $user, Text $Text)
    {
        //
    }
}

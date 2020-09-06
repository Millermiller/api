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

    public function all(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Text $text): bool
    {
        return $user->isAdmin() || $user->hasText($text);
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Text $Text)
    {
        return true;
    }

    public function delete(User $user, Text $Text)
    {
        return true;
    }
}

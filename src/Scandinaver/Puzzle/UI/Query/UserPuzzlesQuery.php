<?php


namespace Scandinaver\Puzzle\UI\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class UserPuzzlesQuery
 *
 * @see     \Scandinaver\Puzzle\Application\Handler\Query\UserPuzzlesHandler
 * @package Scandinaver\Puzzle\UI\Query
 */
class UserPuzzlesQuery implements Query
{
    private User $user;

    private string $language;

    public function __construct(string $language, User $user)
    {
        $this->user = $user;
        $this->language = $language;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
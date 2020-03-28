<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class PersonalAssetsQuery
 * @package Scandinaver\Learn\Application\Query
 *
 * @see \Scandinaver\Learn\Application\Handlers\PersonalAssetsHandler
 */
class PersonalAssetsQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    /**
     * PersonalAssetsQuery constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
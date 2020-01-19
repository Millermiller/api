<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class AssetByForUserByTypeQuery
 * @package Scandinaver\Learn\Application\Query
 */
class AssetForUserByTypeQuery implements Query
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var User
     */
    private $user;

    /**
     * AssetByForUserByTypeQuery constructor.
     * @param string $type
     * @param User $user
     */
    public function __construct(User $user, string $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
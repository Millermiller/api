<?php


namespace Scandinaver\API\Application\Query;

use Illuminate\Contracts\Auth\Authenticatable;
use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class AssetsQuery
 * @package Scandinaver\API\Application\Query
 */
class AssetsQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $language;

    /**
     * AssetsQuery constructor.
     * @param User $user
     * @param string $language
     */
    public function __construct(Authenticatable $user, string $language)
    {
        $this->user = $user;
        $this->language = $language;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }
}
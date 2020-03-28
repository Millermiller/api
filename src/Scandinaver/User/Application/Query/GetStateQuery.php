<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class GetStateQuery
 * @package Scandinaver\User\Application\Query
 */
class GetStateQuery implements Query
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Language
     */
    private $language;

    /**
     * GetStateQuery constructor.
     * @param User $user
     * @param Language $language
     */
    public function __construct(User $user, Language $language)
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
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}
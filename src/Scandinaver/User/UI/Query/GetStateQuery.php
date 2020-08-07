<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class GetStateQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetStateHandler
 * @package Scandinaver\User\UI\Query
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
     *
     * @param  User      $user
     * @param  Language  $language
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
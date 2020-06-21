<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;
use Scandinaver\User\Domain\User;

/**
 * Class PersonalAssetsQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see     \Scandinaver\Learn\Application\Handlers\PersonalAssetsHandler
 */
class PersonalAssetsQuery implements Query
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
     * PersonalAssetsQuery constructor.
     *
     * @param User     $user
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
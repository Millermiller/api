<?php


namespace Scandinaver\Learn\UI\Query;

use Illuminate\Auth\Authenticatable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetsQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetsHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AssetsQuery implements Query
{

    private User $user;

    private Language $language;

    /**
     * AssetsQuery constructor.
     *
     * @param  User  $user
     * @param  Language         $language
     */
    public function __construct(User $user, Language $language)
    {
        $this->user = $user;
        $this->language = $language;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

}
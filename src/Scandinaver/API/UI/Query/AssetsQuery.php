<?php


namespace Scandinaver\API\UI\Query;

use Illuminate\Auth\Authenticatable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetsQuery
 *
 * @see     \Scandinaver\API\Application\Handler\Query\AssetsHandler
 * @package Scandinaver\API\UI\Query
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
     *
     * @param  Authenticatable  $user
     * @param  Language         $language
     */
    public function __construct(Authenticatable $user, Language $language)
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
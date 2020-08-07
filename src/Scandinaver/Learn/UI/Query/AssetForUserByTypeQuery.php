<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetByForUserByTypeQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetForUserByTypeHandler
 * @package Scandinaver\Learn\UI\Query
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
     * @var Language
     */
    private $language;

    /**
     * AssetByForUserByTypeQuery constructor.
     *
     * @param  Language  $language
     * @param  User      $user
     * @param  string    $type
     */
    public function __construct(Language $language, User $user, string $type)
    {
        $this->user = $user;
        $this->type = $type;
        $this->language = $language;
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

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}
<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\User\Domain\Model\User;

/**
 * Class PersonalAssetsQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\PersonalAssetsHandler
 * @package Scandinaver\Learn\UI\Query
 */
class PersonalAssetsQuery implements Query
{
    private User $user;

    private Language $language;

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
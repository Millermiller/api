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
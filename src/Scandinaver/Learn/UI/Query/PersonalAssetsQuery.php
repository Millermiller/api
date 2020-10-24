<?php


namespace Scandinaver\Learn\UI\Query;

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

    private string $language;

    public function __construct(User $user, string $language)
    {
        $this->user = $user;
        $this->language = $language;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
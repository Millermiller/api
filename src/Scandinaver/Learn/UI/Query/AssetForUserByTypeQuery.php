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
    private string $type;

    private User $user;

    private Language $language;

    public function __construct(Language $language, User $user, string $type)
    {
        $this->user = $user;
        $this->type = $type;
        $this->language = $language;
    }

    public function getType(): string
    {
        return $this->type;
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
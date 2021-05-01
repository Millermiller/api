<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class GetStateQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetStateQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class GetStateQuery implements CommandInterface
{
    private User $user;

    private string $language;

    public function __construct(User $user, string $language)
    {
        $this->user     = $user;
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
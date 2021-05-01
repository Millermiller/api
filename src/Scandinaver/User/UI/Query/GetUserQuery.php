<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class GetUserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetUserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class GetUserQuery implements CommandInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
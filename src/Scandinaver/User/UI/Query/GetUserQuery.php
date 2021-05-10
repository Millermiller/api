<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetUserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\GetUserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class GetUserQuery implements QueryInterface
{

    private UserInterface $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
}
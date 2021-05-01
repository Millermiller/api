<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class UserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class UserQuery implements CommandInterface
{
    private $key;

    /**
     * UserQuery constructor.
     *
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
}
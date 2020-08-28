<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class UserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserHandler
 * @package Scandinaver\User\UI\Query
 */
class UserQuery implements Query
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }
}
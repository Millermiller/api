<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class UserQuery
 *
 * @package Scandinaver\User\Application\Query
 * @see     \Scandinaver\User\Application\Handlers\UserHandler
 */
class UserQuery implements Query
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }
}
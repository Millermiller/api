<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class UsersQuery
 * @package Scandinaver\User\Application\Query
 */
class UsersQuery implements Query
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
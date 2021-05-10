<?php


namespace Scandinaver\User\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class UserQuery
 *
 * @see     \Scandinaver\User\Application\Handler\Query\UserQueryHandler
 * @package Scandinaver\User\UI\Query
 */
class UserQuery implements QueryInterface
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
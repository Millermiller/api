<?php


namespace Scandinaver\User\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class LoginQuery
 * @package Scandinaver\User\Application\Query
 *
 * @see \Scandinaver\User\Application\Handlers\LoginHandler
 */
class LoginQuery implements Query
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;
    /**
     * @var array
     */
    private $credentials;

    /**
     * LoginQuery constructor.
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }
}
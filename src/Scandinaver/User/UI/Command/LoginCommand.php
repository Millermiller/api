<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class LoginCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\LoginHandler
 * @package Scandinaver\User\UI\Command
 */
class LoginCommand implements Command
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
     * LoginCommand constructor.
     *
     * @param  array  $credentials
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
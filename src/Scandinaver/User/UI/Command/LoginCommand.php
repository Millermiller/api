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
    private string $login;

    private string $password;

    private array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }
}
<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\User\Application\Handler\Command\LoginCommandHandler;

/**
 * Class LoginCommand
 *
 * @package Scandinaver\User\UI\Command
 */
#[Handler(LoginCommandHandler::class)]
class LoginCommand implements CommandInterface
{

    private array $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getCredentials(): array
    {
        return $this->credentials;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\DTO\UserDTO;

/**
 * Class CreateUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\CreateUserCommandHandler
 * @package Scandinaver\User\UI\Command
 */
class CreateUserCommand implements CommandInterface
{

    private array $data;

    /**
     * CreateUserCommand constructor.
     *
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function buildDTO(): UserDTO
    {
        return UserDTO::fromArray($this->data);
    }
}
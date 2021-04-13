<?php


namespace Scandinaver\User\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class CreateUserCommand
 *
 * @see     \Scandinaver\User\Application\Handler\Command\CreateUserHandler
 * @package Scandinaver\User\UI\Command
 */
class CreateUserCommand implements Command
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

}
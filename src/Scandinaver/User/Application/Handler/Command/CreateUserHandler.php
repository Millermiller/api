<?php


namespace Scandinaver\User\Application\Handler\Command;

use Scandinaver\User\Domain\Contract\Command\CreateUserHandlerInterface;
use Scandinaver\User\UI\Command\CreateUserCommand;

/**
 * Class CreateUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreateUserHandler implements CreateUserHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param  CreateUserCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
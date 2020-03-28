<?php


namespace Scandinaver\User\Application\Handlers;

use Scandinaver\User\Application\Commands\CreateUserCommand;

/**
 * Class CreateUserHandler
 *
 * @package Scandinaver\User\Application\Handlers
 */
class CreateUserHandler implements CreateUserHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param CreateUserCommand
     *
     * @inheritDoc
     */
    public function handle($command): void
    {
        // TODO: Implement handle() method.
    }
} 
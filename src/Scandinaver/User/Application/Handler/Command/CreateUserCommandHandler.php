<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class CreateUserCommandHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreateUserCommandHandler extends AbstractHandler
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateUserCommand|CommandInterface  $command
     *
     * @throws Exception
     */
    public function handle(CommandInterface $command): void
    {
        $user = $this->service->registration($command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 
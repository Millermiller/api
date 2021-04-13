<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Contract\Command\CreateUserHandlerInterface;
use Scandinaver\User\Domain\Services\UserService;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\User\UI\Resources\UserTransformer;

/**
 * Class CreateUserHandler
 *
 * @package Scandinaver\User\Application\Handler\Command
 */
class CreateUserHandler extends AbstractHandler implements CreateUserHandlerInterface
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreateUserCommand|Command  $command
     *
     * @throws Exception
     */
    public function handle($command): void
    {
        $user = $this->service->registration($command->getData());

        $this->resource = new Item($user, new UserTransformer());
    }
} 
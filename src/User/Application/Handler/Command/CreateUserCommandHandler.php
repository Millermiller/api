<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\User\Domain\Service\UserService;
use Scandinaver\User\UI\Command\CreateUserCommand;
use Scandinaver\User\UI\Resource\UserTransformer;

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
     * @param  CreateUserCommand|BaseCommandInterface  $command
     *
     * @throws Exception
     */
    public function handle(BaseCommandInterface $command): void
    {
        $user = $this->service->registration($command->buildDTO());

        $this->resource = new Item($user, new UserTransformer());
    }
} 
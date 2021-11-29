<?php


namespace Scandinaver\User\Application\Handler\Command;

use Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
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

    public function __construct(private UserService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreateUserCommand  $command
     *
     * @throws Exception
     */
    public function handle(CommandInterface $command): void
    {
        $user = $this->service->registration($command->buildDTO());

        $this->resource = new Item($user, new UserTransformer());
    }
} 
<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\CommandInterface;

/**
 * Class CreatePermissionCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionCommandHandler extends AbstractHandler
{

    public function __construct(private RBACService $service)
    {
        parent::__construct();
    }

    /**
     * @param  CreatePermissionCommand  $command
     *
     * @throws PermissionDublicateException
     * @throws PermissionGroupNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $permission = $this->service->createPermission($command->buildDTO());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 
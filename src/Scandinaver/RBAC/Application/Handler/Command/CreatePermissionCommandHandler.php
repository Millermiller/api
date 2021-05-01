<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Services\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Resources\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class CreatePermissionCommandHandler
 *
 * @package Scandinaver\RBAC\Application\Handler\Command
 */
class CreatePermissionCommandHandler extends AbstractHandler
{

    private RBACService $service;

    public function __construct(RBACService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * @param  CreatePermissionCommand|CommandInterface  $command
     *
     * @throws PermissionDublicateException
     * @throws PermissionGroupNotFoundException
     */
    public function handle(CommandInterface $command): void
    {
        $permission = $this->service->createPermission($command->getData());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 
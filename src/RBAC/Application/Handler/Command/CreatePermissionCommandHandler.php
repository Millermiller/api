<?php


namespace Scandinaver\RBAC\Application\Handler\Command;

use League\Fractal\Resource\Item;
use Scandinaver\RBAC\Domain\Exception\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\RBAC\UI\Command\CreatePermissionCommand;
use Scandinaver\RBAC\UI\Resource\PermissionTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  CreatePermissionCommand|BaseCommandInterface  $command
     *
     * @throws PermissionDublicateException
     * @throws PermissionGroupNotFoundException
     */
    public function handle(BaseCommandInterface $command): void
    {
        $permission = $this->service->createPermission($command->buildDTO());

        $this->fractal->parseIncludes('group');

        $this->resource = new Item($permission, new PermissionTransformer());
    }
} 
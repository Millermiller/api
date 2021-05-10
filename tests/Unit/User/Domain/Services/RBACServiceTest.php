<?php

namespace Tests\Unit\User\Domain\Services;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\RBAC\Domain\DTO\PermissionDTO;
use Scandinaver\RBAC\Domain\DTO\RoleDTO;
use Scandinaver\RBAC\Domain\Exception\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exception\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exception\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exception\RoleDublicateException;
use Scandinaver\RBAC\Domain\Exception\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\RBAC\Domain\Service\RBACService;
use Scandinaver\User\Domain\Model\User;
use Tests\TestCase;

/**
 * Class RBACServiceTest
 *
 * @package Tests\Unit\User\Domain\Services
 */
class RBACServiceTest extends TestCase
{

    /**
     * @var RBACService
     */
    private $service;

    private User $user;

    /**
     * @throws BindingResolutionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = entity(User::class, 1)->create();

        $this->service = app()->make('Scandinaver\RBAC\Domain\Service\RBACService');
        entity(Role::class, 1)->create();
    }

    public function testGetAllRoles()
    {
        $roles = $this->service->getAllRoles();

        static::assertIsArray($roles);
    }

    /**
     * @throws RoleDublicateException
     */
    public function testCreateRole()
    {
        $data = [
            'name'        => 'TEST NAME',
            'slug'        => 'TEST SLUG',
            'description' => 'TEST DESCRIPTION',
        ];

        $role = $this->service->createRole(RoleDTO::fromArray($data));

        static::assertInstanceOf(Role::class, $role);
    }


    public function testDeleteRole()
    {
        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        try {
            $this->service->deleteRole($role->getId());
            self::assertTrue(TRUE);
        } catch (Exception $e) {
            self::fail($e->getMessage());
        }
    }

    public function testDeleteRoleThatNotExists()
    {
        $this->expectException(RoleNotFoundException::class);
        $this->service->deleteRole(9999);
    }

    /**
     * @throws PermissionGroupNotFoundException
     * @throws PermissionNotFoundException
     */
    public function testUpdatePermission()
    {
        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();
        /** @var PermissionGroup $permissionGroup */
        $permissionGroup = entity(PermissionGroup::class, 1)->create();

        $newName        = 'newName';
        $newSlug        = 'newSlug';
        $newDescription = 'newDescription';

        $data = [
            'name'        => $newName,
            'slug'        => $newSlug,
            'description' => $newDescription,
            'group'       => $permissionGroup->getId(),
        ];

        /** @var Permission $result */
        $result = $this->service->updatePermission($permission->getId(), $data);
        self::assertInstanceOf(Permission::class, $result);

        self::assertEquals($newName, $result->getName());
        self::assertEquals($newSlug, $result->getSlug());
        self::assertEquals($newDescription, $result->getDescription());

        self::assertInstanceOf(PermissionGroup::class, $result->getGroup());
    }

    /**
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     */
    public function testAttachPermissionToRole()
    {
        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();

        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        $this->service->attachPermissionToRole($role->getId(), $permission->getId());

        self::assertTrue($role->hasPermission($permission));
    }

    /**
     * @throws Exception
     */
    public function testDetachPermissionFromUser()
    {
        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();

        /** @var User $user */
        $user = entity(User::class, 1)->create();

        $user->allow($permission);

        $this->service->detachPermissionFromUser($user, $permission);

        self::assertFalse($user->can($permission->getSlug()));
    }

    /**
     * @throws Exception
     */
    public function testAttachRoleToUser()
    {
        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        /** @var User $user */
        $user = entity(User::class, 1)->create();

        $this->service->attachRoleToUser($user, $role);

        self::assertTrue($user->hasRole($role->getSlug()));
    }

    /**
     * @throws Exception
     */
    public function testAttachPermissionToUser()
    {
        /** @var User $user */
        $user = entity(User::class, 1)->create();

        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();

        $this->service->attachPermissionToUser($user, $permission);

        self::assertTrue($user->can($permission->getSlug()));
    }

    /**
     * @throws RoleNotFoundException
     */
    public function testUpdateRole()
    {
        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        $testRoleName = 'TEST_PERMISSION';
        $testRoleSlug = 'TEST_SLUG';

        $data = [
            'name'        => $testRoleName,
            'slug'        => $testRoleSlug,
            'description' => '',
        ];

        $result = $this->service->updateRole($role->getId(), $data);
        self::assertInstanceOf(Role::class, $result);

        self::assertEquals($testRoleName, $result->getName());
        self::assertEquals($testRoleSlug, $result->getSlug());
        self::assertEquals('', $result->getDescription());
    }

    /**
     * @throws PermissionGroupNotFoundException
     * @throws PermissionDublicateException
     */
    public function testCreatePermission()
    {
        $testPermissionName        = 'TEST_PERMISSION';
        $testPermissionSlug        = 'TEST_SLUG';
        $testPermissionDescription = 'TEST_DESCRIPTION';

        /** @var PermissionGroup $permissionGroup */
        $permissionGroup = entity(PermissionGroup::class, 1)->create();

        $data = [
            'name'        => $testPermissionName,
            'slug'        => $testPermissionSlug,
            'description' => $testPermissionDescription,
            'group'       => $permissionGroup->getId(),
        ];

        $result = $this->service->createPermission(PermissionDTO::fromArray($data));
        self::assertInstanceOf(Permission::class, $result);

        self::assertEquals($testPermissionName, $result->getName());
        self::assertEquals($testPermissionSlug, $result->getSlug());
        self::assertEquals($testPermissionDescription, $result->getDescription());
        self::assertInstanceOf(PermissionGroup::class, $result->getGroup());
    }

    /**
     * @throws PermissionNotFoundException
     * @throws RoleNotFoundException
     * @throws Exception
     */
    public function testDetachPermissionFromRole()
    {
        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();

        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        $role->attachPermission($permission);

        self::assertTrue($role->hasPermission($permission));

        $this->service->detachPermissionFromRole($role->getId(), $permission->getId());

        self::assertFalse($role->hasPermission($permission));
    }

    public function testDeletePermission()
    {
        /** @var Permission $permission */
        $permission = entity(Permission::class, 1)->create();

        try {
            $this->service->deletePermission($permission->getId());
            self::assertTrue(TRUE);
        } catch (Exception $e) {
            self::fail($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function testDetachRoleFromUser()
    {
        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        /** @var User $user */
        $user = entity(User::class, 1)->create();

        $user->attachRole($role);

        $this->service->detachRoleFromUser($user, $role);

        self::assertFalse($user->hasRole($role->getSlug()));
    }
}

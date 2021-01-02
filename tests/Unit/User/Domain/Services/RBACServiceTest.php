<?php

namespace Tests\Unit\User\Domain\Services;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionGroupNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\PermissionNotFoundException;
use Scandinaver\RBAC\Domain\Exceptions\RoleDublicateException;
use Scandinaver\RBAC\Domain\Exceptions\RoleNotFoundException;
use Scandinaver\RBAC\Domain\Model\Permission;
use Scandinaver\RBAC\Domain\Model\PermissionDTO;
use Scandinaver\RBAC\Domain\Model\PermissionGroup;
use Scandinaver\RBAC\Domain\Model\PermissionGroupDTO;
use Scandinaver\RBAC\Domain\Model\Role;
use Scandinaver\RBAC\Domain\Model\RoleDTO;
use Scandinaver\RBAC\Domain\Services\RBACService;
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

        $this->service = app()->make('Scandinaver\RBAC\Domain\Services\RBACService');
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
            'name' => 'TEST NAME',
            'slug' => 'TEST SLUG',
            'description' => 'TEST DESCRIPTION'
        ];

        $role = $this->service->createRole($data);

        static::assertInstanceOf(RoleDTO::class, $role);
    }


    public function testDeleteRole()
    {
        /** @var Role $role */
        $role = entity(Role::class, 1)->create();

        try {
            $this->service->deleteRole($role->getId());
            self::assertTrue(true);
        } catch (\Exception $e) {
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

        $newName = 'newName';
        $newSlug = 'newSlug';
        $newDescription = 'newDescription';

        $data = [
          'name' => $newName,
          'slug' => $newSlug,
          'description' => $newDescription,
          'group' => $permissionGroup->getId()
        ];

        /** @var PermissionDTO $result */
        $result = $this->service->updatePermission($permission->getId(), $data);
        self::assertInstanceOf(PermissionDTO::class, $result);

        $decoded = $result->jsonSerialize();
        self::assertEquals($newName, $decoded['name']);
        self::assertEquals($newSlug, $decoded['slug']);
        self::assertEquals($newDescription, $decoded['description']);
        self::assertInstanceOf(PermissionGroupDTO::class, $decoded['group']);
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
          'name' => $testRoleName,
          'slug' => $testRoleSlug,
          'description' => '',
        ];

        $result = $this->service->updateRole($role->getId(), $data);
        self::assertInstanceOf(RoleDTO::class, $result);

        $decoded = $result->jsonSerialize();

        self::assertEquals($testRoleName, $decoded['name']);
        self::assertEquals($testRoleSlug, $decoded['slug']);
        self::assertEquals('', $decoded['description']);
    }

    /**
     * @throws PermissionGroupNotFoundException
     * @throws PermissionDublicateException
     */
    public function testCreatePermission()
    {
        $testPermissionName = 'TEST_PERMISSION';
        $testPermissionSlug = 'TEST_SLUG';
        $testPermissionDescription = 'TEST_DESCRIPTION';

        /** @var PermissionGroup $permissionGroup */
        $permissionGroup = entity(PermissionGroup::class, 1)->create();

        $data = [
          'name' => $testPermissionName,
          'slug' => $testPermissionSlug,
          'description' => $testPermissionDescription,
          'group' => $permissionGroup->getId()
        ];

        $result = $this->service->createPermission($data);
        self::assertInstanceOf(PermissionDTO::class, $result);

        $decoded = $result->jsonSerialize();

        self::assertEquals($testPermissionName, $decoded['name']);
        self::assertEquals($testPermissionSlug, $decoded['slug']);
        self::assertEquals($testPermissionDescription, $decoded['description']);
        self::assertInstanceOf(PermissionGroupDTO::class, $decoded['group']);
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
            self::assertTrue(true);
        } catch (\Exception $e) {
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

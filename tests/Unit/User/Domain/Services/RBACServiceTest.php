<?php

namespace Tests\Unit\User\Domain\Services;

use Scandinaver\User\Domain\Model\RoleDTO;
use Scandinaver\User\Domain\Services\RBACService;
use Tests\TestCase;

class RBACServiceTest extends TestCase
{

    /**
     * @var RBACService
     */
    private $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app()->make('Scandinaver\User\Domain\Services\RBACService');
    }

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
    }

    public function testUpdatePermission()
    {
    }

    public function testAttachPermissionToRole()
    {
    }

    public function testDetachPermissionFromUser()
    {
    }

    public function testAttachRoleToUser()
    {
    }

    public function testAttachPermissionToUser()
    {
    }

    public function testUpdateRole()
    {
    }

    public function testCreatePermission()
    {
    }

    public function testDetachPermissionFromRole()
    {
    }

    public function testDeletePermission()
    {
    }

    public function testDetachRoleFromUser()
    {
    }
}

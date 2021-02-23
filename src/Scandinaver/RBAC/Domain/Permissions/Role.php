<?php


namespace Scandinaver\RBAC\Domain\Permissions;


/**
 * Class Role
 *
 * @package Scandinaver\RBAC\Domain\Permissions
 */
class Role
{
    public const VIEW   = 'view-roles';
    public const SHOW   = 'show-role';
    public const CREATE = 'create-role';
    public const UPDATE = 'update-role';
    public const DELETE = 'delete-role';
}
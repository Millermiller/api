<?php


namespace Scandinaver\RBAC\Domain\Permissions;


/**
 * Class PermissionGroup
 *
 * @package Scandinaver\RBAC\Domain\Permissions
 */
class PermissionGroup
{
    public const VIEW   = 'view-permission-groups';
    public const SHOW   = 'show-permission-group';
    public const CREATE = 'create-permission-group';
    public const UPDATE = 'update-permission-group';
    public const DELETE = 'delete-permission-group';
}
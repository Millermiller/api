<?php


namespace Scandinaver\RBAC\Domain\Permissions;


/**
 * Class Permission
 *
 * @package Scandinaver\RBAC\Domain\Permissions
 */
class Permission
{
    public const VIEW   = 'view-permissions';
    public const SHOW   = 'show-permission';
    public const CREATE = 'create-permission';
    public const UPDATE = 'update-permission';
    public const DELETE = 'delete-permission';
}
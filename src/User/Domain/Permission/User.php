<?php


namespace Scandinaver\User\Domain\Permission;


/**
 * Class User
 *
 * @package Scandinaver\User\Domain\Permission
 */
class User
{

    public const VIEW   = 'view-users';
    public const SHOW   = 'show-user';
    public const CREATE = 'create-user';
    public const UPDATE = 'update-user';
    public const DELETE = 'delete-user';
}
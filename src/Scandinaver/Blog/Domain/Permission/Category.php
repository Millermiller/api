<?php


namespace Scandinaver\Blog\Domain\Permission;


/**
 * Class Category
 *
 * @package Scandinaver\Blog\Domain\Permission
 */
class Category
{
    public const VIEW   = 'view-categories';
    public const SHOW   = 'show-category';
    public const CREATE = 'create-category';
    public const UPDATE = 'update-category';
    public const DELETE = 'delete-category';
}
<?php


namespace Scandinaver\Blog\Domain\Permission;


/**
 * Class Post
 *
 * @package Scandinaver\Blog\Domain\Permission
 */
class Post
{
    public const VIEW   = 'view-posts';
    public const SHOW   = 'show-post';
    public const CREATE = 'create-post';
    public const UPDATE = 'update-post';
    public const DELETE = 'delete-post';
}
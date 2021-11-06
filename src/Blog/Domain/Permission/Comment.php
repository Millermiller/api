<?php


namespace Scandinaver\Blog\Domain\Permission;


/**
 * Class Comment
 *
 * @package Scandinaver\Blog\Domain\Permission
 */
class Comment
{

    public const VIEW   = 'view-comments';
    public const SHOW   = 'show-comment';
    public const CREATE = 'create-comment';
    public const UPDATE = 'update-comment';
    public const DELETE = 'delete-comment';
    public const SEARCH = 'delete-comment';
}
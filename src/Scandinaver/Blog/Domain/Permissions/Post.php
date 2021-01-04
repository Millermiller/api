<?php


namespace Scandinaver\Blog\Domain\Permissions;


class Post
{
    public const VIEW = 'view-posts';
    public const SHOW = 'show-post';
    public const CREATE = 'create-post';
    public const UPDATE = 'update-post';
    public const DELETE = 'delete-post';
}
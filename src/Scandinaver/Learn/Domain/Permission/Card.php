<?php


namespace Scandinaver\Learn\Domain\Permission;


/**
 * Class Card
 *
 * @package Scandinaver\Learn\Domain\Permission
 */
class Card
{
    public const VIEW   = 'view-cards';
    public const SHOW   = 'show-card';
    public const CREATE = 'create-card';
    public const UPDATE = 'update-card';
    public const DELETE = 'delete-card';
    public const SEARCH = 'search-card';
}
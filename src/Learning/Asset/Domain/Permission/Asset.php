<?php


namespace Scandinaver\Learning\Asset\Domain\Permission;


/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Permission
 */
class Asset
{
    public const VIEW             = 'view-assets';
    public const SHOW             = 'show-asset';
    public const CREATE           = 'create-asset';
    public const UPDATE           = 'update-asset';
    public const DELETE           = 'delete-asset';
    public const CREATE_FAVOURITE = 'create-favourite';
    public const DELETE_FAVOURITE = 'delete-favourite';
    public const ADD_CARD         = 'add-card';
}
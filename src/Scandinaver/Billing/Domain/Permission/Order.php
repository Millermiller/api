<?php


namespace Scandinaver\Billing\Domain\Permission;

/**
 * Class Order
 *
 * @package Scandinaver\Billing\Domain\Permission
 */
class Order
{
    public const VIEW     = 'view-orders';
    public const SHOW     = 'show-order';
    public const CREATE   = 'create-order';
    public const UPDATE   = 'update-order';
    public const DELETE   = 'delete-order';
}
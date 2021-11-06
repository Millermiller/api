<?php


namespace Scandinaver\Billing\Domain\Permission;

/**
 * Class Payment
 *
 * @package Scandinaver\Billing\Domain\Permission
 */
class Payment
{
    public const VIEW     = 'view-payments';
    public const SHOW     = 'show-payment';
    public const CREATE   = 'create-payment';
    public const UPDATE   = 'update-payment';
    public const DELETE   = 'delete-payment';
}
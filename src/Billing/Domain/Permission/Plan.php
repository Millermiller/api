<?php


namespace Scandinaver\Billing\Domain\Permission;

/**
 * Class Plan
 *
 * @package Scandinaver\Billing\Domain\Permission
 */
class Plan
{
    public const VIEW     = 'view-plans';
    public const SHOW     = 'show-plan';
    public const CREATE   = 'create-plan';
    public const UPDATE   = 'update-plan';
    public const DELETE   = 'delete-plan';
}
<?php


namespace Scandinaver\Shared\Contract;


/**
 * Interface Factory
 *
 * @package Scandinaver\Shared\Contract
 */
interface Factory
{

    public static function build(array $data): object;
}
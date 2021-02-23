<?php


namespace Scandinaver\Shared\Contract;


/**
 * Interface EqualInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface EqualInterface
{
    public function isEqualTo(EqualInterface $to): bool;
}
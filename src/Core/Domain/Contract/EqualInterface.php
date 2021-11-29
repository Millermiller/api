<?php


namespace Scandinaver\Core\Domain\Contract;


/**
 * Interface EqualInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface EqualInterface
{
    public function isEqualTo(EqualInterface $to): bool;
}
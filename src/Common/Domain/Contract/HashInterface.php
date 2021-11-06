<?php


namespace Scandinaver\Common\Domain\Contract;

/**
 * Interface HashInterface
 *
 * @package Scandinaver\Common\Domain\Contract
 */
interface HashInterface
{
    public function hash(string $string): string;

    public function check(string $string, string $hash): bool;
}
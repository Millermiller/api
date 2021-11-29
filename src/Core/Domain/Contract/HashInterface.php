<?php


namespace Scandinaver\Core\Domain\Contract;

/**
 * Interface HashInterface
 *
 * @package Scandinaver\Core\Domain\Contract
 */
interface HashInterface
{
    public function hash(string $string): string;

    public function check(string $string, string $hash): bool;
}
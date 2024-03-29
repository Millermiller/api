<?php


namespace Scandinaver\Core\Infrastructure\Service;

use Hash;
use Scandinaver\Core\Domain\Contract\HashInterface;

/**
 * Class LaravelHash
 *
 * @package Scandinaver\Common\Infrastructure\Service
 */
class LaravelHash implements HashInterface
{

    public function hash(string $string): string
    {
        // return Hash::make($string);
        return md5($string);
    }

    public function check(string $string, string $hash): bool
    {
        return Hash::check($string, $hash);
    }
}
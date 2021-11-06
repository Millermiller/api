<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface BaseServiceInterface
 *
 * @template T
 * @package Scandinaver\Shared\Contract
 */
interface BaseServiceInterface
{

    /**
     * @return T[]
     */
    public function all(): array;

    /**
     * @param  int  $id
     *
     * @return T
     */
    public function one(int $id);
}
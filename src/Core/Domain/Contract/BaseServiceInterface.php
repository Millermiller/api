<?php


namespace Scandinaver\Core\Domain\Contract;

/**
 * Interface BaseServiceInterface
 *
 * @template T
 * @package Scandinaver\Core\Domain\Contract
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
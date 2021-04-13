<?php


namespace Scandinaver\Shared\Contract;

/**
 * Interface BaseServiceInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface BaseServiceInterface
{

    public function all(): array;

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function one(int $id);
}
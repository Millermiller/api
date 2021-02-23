<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\DTO;

/**
 * Interface BaseServiceInterface
 *
 * @package Scandinaver\Shared\Contract
 */
interface BaseServiceInterface
{

    public function all(): array;

    public function one(int $id): DTO;
}
<?php


namespace Scandinaver\Shared\Contract;


use Scandinaver\Shared\DTO;

interface BaseServiceInterface
{

    public function all(): array;

    public function one(int $id): DTO;
}
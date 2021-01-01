<?php


namespace Scandinaver\Shared\Contract;


interface Factory
{

    public static function build(array $data): object;
}
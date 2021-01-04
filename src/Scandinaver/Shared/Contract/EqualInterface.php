<?php


namespace Scandinaver\Shared\Contract;


interface EqualInterface
{
    public function isEqualTo(EqualInterface $to): bool;
}
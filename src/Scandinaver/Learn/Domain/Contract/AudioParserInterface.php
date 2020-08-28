<?php


namespace Scandinaver\Learn\Domain\Contract;

/**
 * Interface AudioParserInterface
 *
 * @package Scandinaver\Learn\Domain\Contract
 */
interface AudioParserInterface
{
    public function parse(string $word): string;
}
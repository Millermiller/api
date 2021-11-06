<?php


namespace Scandinaver\Learning\Asset\Domain\Contract;

/**
 * Interface AudioParserInterface
 *
 * @package Scandinaver\Learn\Domain\Contract
 */
interface AudioParserInterface
{
    public function parse(string $word): string;
}
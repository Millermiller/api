<?php


namespace Scandinaver\Learn\Domain\Contract;

/**
 * Interface AudioParserInterface
 *
 * @package Scandinaver\Learn\Domain\Contract
 */
interface AudioParserInterface
{
    /**
     * @param  string  $word
     *
     * @return string
     */
    public function parse(string $word): string;
}
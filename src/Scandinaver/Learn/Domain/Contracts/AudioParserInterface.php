<?php


namespace Scandinaver\Learn\Domain\Contracts;

/**
 * Interface AudioParserInterface
 *
 * @package Scandinaver\Learn\Domain\Contracts
 */
interface AudioParserInterface
{
    /**
     * @param string $word
     *
     * @return string
     */
    public function parse(string $word): string;
}
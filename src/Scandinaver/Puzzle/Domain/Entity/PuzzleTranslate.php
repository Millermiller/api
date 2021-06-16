<?php


namespace Scandinaver\Puzzle\Domain\Entity;

use Scandinaver\Shared\ValueObject;

/**
 * Class PuzzleTranslate
 *
 * @package Scandinaver\Puzzle\Domain\Entity
 */
class PuzzleTranslate extends ValueObject
{
    protected $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }
}
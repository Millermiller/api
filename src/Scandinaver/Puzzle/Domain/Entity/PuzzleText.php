<?php


namespace Scandinaver\Puzzle\Domain\Entity;

use Scandinaver\Shared\StringValueObject;

/**
 * Class PuzzleText
 *
 * @package Scandinaver\Puzzle\Domain\Entity
 */
class PuzzleText extends StringValueObject
{
    protected string $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }
}
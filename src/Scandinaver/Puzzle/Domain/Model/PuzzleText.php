<?php


namespace Scandinaver\Puzzle\Domain\Model;

use Scandinaver\Shared\StringValueObject;

/**
 * Class PuzzleText
 *
 * @package Scandinaver\Puzzle\Domain\Model
 */
class PuzzleText extends StringValueObject
{
    protected string $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }
}
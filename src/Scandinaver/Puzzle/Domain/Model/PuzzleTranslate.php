<?php


namespace Scandinaver\Puzzle\Domain\Model;

use Scandinaver\Shared\ValueObject;

/**
 * Class PuzzleTranslate
 *
 * @package Scandinaver\Puzzle\Domain\Model
 */
class PuzzleTranslate extends ValueObject
{
    protected $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }
}
<?php


namespace Scandinaver\Puzzle\Domain\Model;


use Doctrine\ORM\Mapping as ORM;
use Scandinaver\Shared\StringValueObject;

/**
 * @ORM\Embeddable
 */
class PuzzleText extends StringValueObject
{

    /** @ORM\Column(type = "string") */
    protected string $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }

}
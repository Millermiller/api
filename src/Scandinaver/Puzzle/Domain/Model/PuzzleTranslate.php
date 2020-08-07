<?php


namespace Scandinaver\Puzzle\Domain\Model;


use Doctrine\ORM\Mapping as ORM;
use Scandinaver\Shared\ValueObject;

/**
 * @ORM\Embeddable
 */
class PuzzleTranslate extends ValueObject
{

    /** @ORM\Column(type = "string") */
    protected $value;

    public function __construct(string $text)
    {
        $this->fromNative($text);
    }

}
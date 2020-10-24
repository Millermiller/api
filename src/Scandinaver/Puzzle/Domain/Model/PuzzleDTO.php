<?php


namespace Scandinaver\Puzzle\Domain\Model;


use Scandinaver\Shared\DTO;

class PuzzleDTO extends DTO
{

    private Puzzle $puzzle;

    public function __construct(Puzzle $puzzle)
    {
        $this->puzzle = $puzzle;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->puzzle->getId(),
            'text' => $this->puzzle->getText()->toNative(),
            'translate' => $this->puzzle->getTranslate()->toNative(),
        ];
    }
}
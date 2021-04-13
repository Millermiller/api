<?php


namespace Scandinaver\Puzzle\Domain\DTO;

use Scandinaver\Shared\DTO;

/**
 * Class PuzzleDTO
 *
 * @package Scandinaver\Puzzle\Domain\Model
 */
class PuzzleDTO extends DTO
{
    private ?int $id;

    private string $text;

    private string $translate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

    public function setTranslate(string $translate): void
    {
        $this->translate = $translate;
    }
}
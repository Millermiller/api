<?php


namespace Scandinaver\Learning\Puzzle\Domain\DTO;

use Scandinaver\Core\Domain\DTO;

/**
 * Class PuzzleDTO
 *
 * @package Scandinaver\Puzzle\Domain\Entity
 */
class PuzzleDTO extends DTO
{
    private ?int $id;

    private string $text;

    private string $translate;

    private string $languageLetter;

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

    public function getLanguageLetter(): string
    {
        return $this->languageLetter;
    }

    public function setLanguageLetter(string $languageLetter): void
    {
        $this->languageLetter = $languageLetter;
    }

    public static function fromArray(array $data): PuzzleDTO
    {
        $puzzleDTO = new self();

        $puzzleDTO->setId($data['id'] ?? NULL);
        $puzzleDTO->setText($data['text']);
        $puzzleDTO->setTranslate($data['translate']);
        $puzzleDTO->setLanguageLetter($data['languageLetter']);

        return $puzzleDTO;
    }
}
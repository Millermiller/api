<?php


namespace Scandinaver\Learning\Translate\Domain\DTO;


use Scandinaver\Core\Domain\DTO;

/**
 * Class WordDTO
 *
 * @package Scandinaver\Translate\Domain\DTO
 */
class WordDTO extends DTO
{
    private ?int $id;

    private int $sentenceNum;

    private string $object;

    private ?string $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSentenceNum(): int
    {
        return $this->sentenceNum;
    }

    public function setSentenceNum(int $sentenceNum): void
    {
        $this->sentenceNum = $sentenceNum;
    }

    public function getObject(): string
    {
        return $this->object;
    }

    public function setObject(string $object): void
    {
        $this->object = $object;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    public static function fromArray(array $data): WordDTO
    {
        $wordDTO = new self();
        $wordDTO->setId($data['id'] ?? NULL);
        $wordDTO->setSentenceNum($data['sentenceNum']);
        $wordDTO->setObject($data['word']);
        $wordDTO->setValue($data['orig']);

        return $wordDTO;
    }
}
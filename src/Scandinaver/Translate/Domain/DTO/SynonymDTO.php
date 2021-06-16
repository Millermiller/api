<?php


namespace Scandinaver\Translate\Domain\DTO;


use Scandinaver\Shared\DTO;

/**
 * Class SynonymDTO
 *
 * @package Scandinaver\Translate\Domain\DTO
 */
class SynonymDTO extends DTO
{
    private int $wordId;

    private string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getWordId(): int
    {
        return $this->wordId;
    }

    public function setWordId(int $wordId): void
    {
        $this->wordId = $wordId;
    }

    public static function fromArray(array $data): SynonymDTO
    {
        $synonymDTO = new self();
        $synonymDTO->setValue($data['value']);
        $synonymDTO->setWordId($data['wordId']);
        return $synonymDTO;
    }

}
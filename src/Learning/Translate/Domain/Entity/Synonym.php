<?php


namespace Scandinaver\Learning\Translate\Domain\Entity;

use DateTime;

/**
 * Class Synonym
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Synonym
{
    private ?int $id = NULL;

    private string $value;

    private DictionaryItem $word;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function __construct(DictionaryItem $word, string $value)
    {
        $this->word  = $word;
        $this->value = $value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getWord(): DictionaryItem
    {
        return $this->word;
    }

    public function setWord(DictionaryItem $word): void
    {
        $this->word = $word;
    }
}

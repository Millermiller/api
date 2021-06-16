<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Synonym
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Synonym extends AggregateRoot
{
    private int $id;

    private string $synonym;

    private Word $word;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->synonym;
    }

    public function setValue(string $synonym): void
    {
        $this->synonym = $synonym;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function onDelete()
    {
        // TODO: Implement onDelete() method.
    }
}

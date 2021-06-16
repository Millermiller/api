<?php


namespace Scandinaver\Translate\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Scandinaver\Translate\Domain\DTO\WordDTO;

/**
 * Class Sentence
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Sentence
{
    private int $id;

    /** @var ArrayCollection|WordDTO[] */
    private ArrayCollection $words;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->words = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getWords(): ArrayCollection
    {
        return $this->words;
    }

    public function setWords(ArrayCollection $words): void
    {
        $this->words = $words;
    }

    public function addWord(WordDTO $word): void
    {
        if ($this->words->contains($word) === FALSE) {
            $this->words->add($word);
        }
    }
}
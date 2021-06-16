<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Translate\Domain\Exception\SynonymAlreadyExistsException;

/**
 * Class Word
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Word
{
    private int $id;

    private int $sentenceNum;

    private string $word;

    private ?string $orig = NULL;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;

    private Collection $synonyms;

    public function setText(Text $text): void
    {
        $this->text = $text;
    }

    public function setSentenceNum(int $sentenceNum): void
    {
        $this->sentenceNum = $sentenceNum;
    }

    public function setWord(string $word): void
    {
        $this->word = $word;
    }

    public function getSentenceNum(): int
    {
        return $this->sentenceNum;
    }

    public function getValue(): string
    {
        return $this->word;
    }

    public function getOrig(): ?string
    {
        return $this->orig;
    }

    public function getText(): Text
    {
        return $this->text;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  Synonym  $synonym
     *
     * @throws SynonymAlreadyExistsException
     */
    public function addSynonym(Synonym $synonym): void
    {
        $isContain = $this->synonyms->exists(function($key, $item) use ($synonym) {
            return $item->getValue() === $synonym->getValue();
        });

        if ($isContain === TRUE) {
            throw new SynonymAlreadyExistsException();
        }

        $this->synonyms->add($synonym);
    }

    public function setOrig(?string $orig): void
    {
        $this->orig = $orig;
    }
}

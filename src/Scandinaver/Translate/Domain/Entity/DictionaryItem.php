<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Translate\Domain\Exception\SynonymAlreadyExistsException;

/**
 * Class DictionaryItem
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class DictionaryItem
{
    private ?int $id = NULL;

    private int $sentenceNum;

    private string $object;

    private ?string $value = NULL;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private Text $text;

    private Collection $synonyms;

    private array $coordinates;

    public function __construct()
    {
        $this->synonyms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): Text
    {
        return $this->text;
    }

    public function setText(Text $text): void
    {
        $this->text = $text;
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

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): void
    {
        $this->coordinates = $coordinates;
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

    /**
     * @return ArrayCollection|Collection
     */
    public function getSynonyms()
    {
        return $this->synonyms;
    }
}

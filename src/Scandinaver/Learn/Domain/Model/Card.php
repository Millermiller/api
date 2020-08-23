<?php


namespace Scandinaver\Learn\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Card
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Card extends AggregateRoot
{
    private int $id;

    private Word $word;

    private Translate $translate;

    private User $creator;

    private \DateTime $createdAt;

    private \DateTime $updatedAt;

    private Collection $assets;

    private bool $favourite;

    /**
     * @var Example[]
     */
    private Collection $examples;

    public function __construct()
    {
        $this->word = new Word();
        $this->translate = new Translate();
        $this->examples = new ArrayCollection();
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function setTranslate(Translate $translate): void
    {
        $this->translate = $translate;
    }

    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setFavourite(bool $favourite): void
    {
        $this->favourite = $favourite;
    }

    public function toDTO(): CardDTO
    {
        return new CardDTO($this);
    }
    
    public function isFavourite(): bool
    {
        return $this->favourite;
    }


    public function getTranslate(): Translate
    {
        return $this->translate;
    }

    public function getExamples(): Collection
    {
        return $this->examples;
    }
}
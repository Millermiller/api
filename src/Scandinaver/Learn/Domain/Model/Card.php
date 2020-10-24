<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Events\TranslateUpdated;
use Scandinaver\Learn\Domain\Events\WordUpdated;
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

    private ?User $creator;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private Collection $assets;

    private bool $favourite = false;

    private Language $language;

    private int $type;

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

    public function setWordValue(string $value): void
    {
        if ($this->word->getValue() !== $value) {
            $this->pushEvent(new WordUpdated($this->word, $value));
        }

        $this->word->setValue($value);
    }


    public function setTranslateValue($value)
    {
        if ($this->translate->getValue() !== $value) {
            $this->pushEvent(new TranslateUpdated($this->translate, $value));
        }

        $this->translate->setValue($value);
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

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    /**
     * @param  ArrayCollection|Collection  $examples
     */
    public function setExamples(Collection $examples): void
    {
        $this->examples = $examples;
    }

    public function addExample(Example $example): void
    {
        if (!$this->examples->contains($example)) {
            $example->setCard($this);
            $this->examples->add($example);
        }
    }

    public function removeExample(Example $example)
    {
        if ($this->examples->contains($example)) {
            $this->examples->removeElement($example);
        }
    }

    /**
     * @return Collection|Example[]
     */
    public function getExamples(): Collection
    {
        return $this->examples;
    }

    public function clearExamples()
    {
        $this->examples->clear();
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
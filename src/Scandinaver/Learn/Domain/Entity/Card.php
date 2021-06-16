<?php


namespace Scandinaver\Learn\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learn\Domain\Event\TermUpdated;
use Scandinaver\Learn\Domain\Event\TranslateUpdated;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Card
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class Card extends AggregateRoot
{
    const TYPE_WORD = 0;
    const TYPE_SENTENCE = 1;

    private int $id;

    private Term $term;

    private Translate $translate;

    private ?UserInterface $creator = NULL;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private Collection $assets;

    private bool $favourite = FALSE;

    private Language $language;

    private int $type;

    private Collection $examples;

    public function __construct()
    {
        $this->term      = new Term();
        $this->translate = new Translate();
        $this->examples  = new ArrayCollection();
    }

    public function getTerm(): Term
    {
        return $this->term;
    }

    public function setTerm(Term $term): void
    {
        $this->term = $term;
    }

    public function setTranslate(Translate $translate): void
    {
        $this->translate = $translate;
    }

    public function setTermValue(string $value): void
    {
        if ($this->term->getValue() !== $value) {
            $this->pushEvent(new TermUpdated($this->term, $value));
        }

        $this->term->setValue($value);
    }

    public function setTranslateValue(string $value): void
    {
        if ($this->translate->getValue() !== $value) {
            $this->pushEvent(new TranslateUpdated($this->translate, $value));
        }

        $this->translate->setValue($value);
    }

    public function setCreator(UserInterface $creator): void
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

    public function getCreator(): ?UserInterface
    {
        return $this->creator;
    }

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

    public function removeExample(Example $example): void
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

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }

    public function getType(): int
    {
        return $this->type;
    }
}
<?php


namespace Scandinaver\Translate\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Common\Domain\Contract\LearnItemInterface;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\AbstractLearnItem;
use Scandinaver\Common\Domain\Entity\HasLevel;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class Text
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class Text extends AbstractLearnItem implements LearnItemInterface
{
    use HasLevel;

    private int $id;

    private string $title;

    private ?string $description;

    private string $text;

    private string $translate;

    private bool $published;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private ?string $image = NULL;

    private $users;

    private Language $language;

    private Collection $tooltips;

    /** @var Collection|DictionaryItem[] */
    private Collection $dictionary;

    public function __construct()
    {
        $this->tooltips = new ArrayCollection();
        $this->dictionary = new ArrayCollection();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return Collection|UserInterface[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return Collection|DictionaryItem[]
     */
    public function getTranslates(): Collection
    {
        return $this->dictionary;
    }

    /**
     * @return Collection|Tooltip[]
     */
    public function getTooltips(): Collection
    {
        return $this->tooltips;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function onDelete()
    {
        // TODO: Implement delete() method.
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

    public function setTranslate(string $translate): void
    {
        $this->translate = $translate;
    }

    public function addDictionaryItem(DictionaryItem $dictionaryItem): void
    {
        $this->dictionary->add($dictionaryItem);
    }

    public function getSentences(): array
    {
        $sentences = [];

        foreach ($this->dictionary as $dictionaryItem) {
            $sentences[$dictionaryItem->getSentenceNum()][] = [
                'id'          => $dictionaryItem->getId(),
                'orig'        => $dictionaryItem->getValue(),
                'word'        => $dictionaryItem->getObject(),
                'sentenceNum' => $dictionaryItem->getSentenceNum(),
                'textId'      => $dictionaryItem->getText()->getId(),
            ];
        }

        return $sentences;
    }

    public function addWord(DictionaryItem $word): void
    {
        if ($this->dictionary->contains($word) === FALSE) {
            $this->dictionary->add($word);
        }
    }

    public function addTooltip(Tooltip $tooltip): void
    {
        if ($this->tooltips->contains($tooltip) === FALSE) {
            $this->tooltips->add($tooltip);
        }
    }

    public function getDictionary(): Collection
    {
        return $this->dictionary;
    }
}

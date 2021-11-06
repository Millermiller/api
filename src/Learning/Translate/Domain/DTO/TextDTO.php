<?php


namespace Scandinaver\Learning\Translate\Domain\DTO;

use App\Helpers\StringHelper;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Shared\DTO;
use Scandinaver\Learning\Translate\Domain\Entity\Sentence;

/**
 * Class TextDTO
 *
 * @package Scandinaver\Translate\Domain\Entity
 */
class TextDTO extends DTO
{
    private ?int $id;

    private string $title;

    private Language $language;

    private string $languageLetter;

    private int $level;

    private ?string $description = NULL;

    private string $text;

    private string $translate;

    private ?string $image;

    private int $count;

    /** @var TooltipDTO[] $tooltipDTO */
    private array $tooltipDTO;

    private bool $active;

    private bool $available;

    private bool $published;

    /** @var DictionaryItemDTO[] $dictionary */
    private array $dictionary;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getDescription(): ?string
    {
        if ($this->description === NULL) {
            return NULL;
        }

        return StringHelper::cleartext($this->description);
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getText(): string
    {
        return StringHelper::cleartext($this->text);
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function getLanguageLetter(): string
    {
        return $this->languageLetter;
    }

    public function setLanguageLetter(string $languageLetter): void
    {
        $this->languageLetter = $languageLetter;
    }

    public function getTranslate(): string
    {
        return StringHelper::cleartext($this->translate);
    }

    public function setTranslate(string $translate): void
    {
        $this->translate = $translate;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }


    public function getTooltipDTO(): array
    {
        return $this->tooltipDTO;
    }

    public function setTooltipDTO(array $tooltipDTO): void
    {
        $this->tooltipDTO = $tooltipDTO;
    }

    public function getDictionary(): array
    {
        return $this->dictionary;
    }

    public function setDictionary(array $dictionary): void
    {
        $this->dictionary = $dictionary;
    }

    public static function fromArray(array $data): TextDTO
    {
        $textDTO = new self();

        $tooltipsDTO = [];
        foreach ($data['tooltips'] as $tooltipData) {
            $tooltipsDTO[] = TooltipDTO::fromArray($tooltipData);
        }

        $dictionary = [];
        foreach ($data['dictionary'] as $dictionaryItemData) {
            $dictionary[] = DictionaryItemDTO::fromArray($dictionaryItemData);
        }
        $textDTO->setDictionary($dictionary);

        $textDTO->setTitle($data['title']);
        $textDTO->setLanguageLetter($data['language']);
        $textDTO->setText($data['original']);
        $textDTO->setTranslate($data['translate']);
        $textDTO->setTooltipDTO($tooltipsDTO);
        $textDTO->setPublished($data['published']);
        $textDTO->setDescription($data['description'] ?? NULL);

        return $textDTO;
    }
}
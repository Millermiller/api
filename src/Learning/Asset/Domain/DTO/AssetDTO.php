<?php


namespace Scandinaver\Learning\Asset\Domain\DTO;

use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;
use Scandinaver\Core\Domain\DTO;

/**
 * Class AssetDTO
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class AssetDTO extends DTO
{

    private ?int $id;

    private int $type;

    private string $title;

    private Language $language;

    private string $languageLetter;

    private int $languageId;

    private ?UserInterface $user = NULL;

    private ?int $level;

    /** @var CardDTO[] $cards */
    private array $cards;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isBasic(): bool
    {
        return $this->type !== Asset::TYPE_PERSONAL;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getOwner(): ?UserInterface
    {
        return $this->user;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function setUser(?UserInterface $user): void
    {
        $this->user = $user;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    public function getCount(): int
    {
        return count($this->cards);
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getLanguageLetter(): string
    {
        return $this->languageLetter;
    }

    public function setLanguageLetter(string $languageLetter): void
    {
        $this->languageLetter = $languageLetter;
    }

    public static function fromArray(array $data): AssetDTO
    {
        $assetDTO = new self();

        $assetDTO->setId($data['id'] ?? NULL);
        $assetDTO->setTitle($data['title']);
        $assetDTO->setType($data['type']);
        $assetDTO->setLevel($data['level']);
        $assetDTO->setLanguageLetter($data['language']);

        return $assetDTO;
    }
}
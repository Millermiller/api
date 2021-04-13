<?php


namespace Scandinaver\Learn\Domain\DTO;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Model\Passing;
use Scandinaver\Shared\DTO;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AssetDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class AssetDTO extends DTO
{
    private ?int $id;

    private bool $active = FALSE;

    private bool $available = FALSE;

    private bool $completed = FALSE;

    private ?Passing $bestResult = NULL;

    private int $type;

    private string $title;

    private bool $basic;

    private Language $language;
    
    private ?User $user = NULL;
    
    private ?int $level;

    /** @var CardDTO[] $cards  */
    private array $cards;

    public function getBestResult(): ?Passing
    {
        return $this->bestResult;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isBasic(): bool
    {
        return $this->basic;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function setBestResult(?Passing $bestResult): void
    {
        $this->bestResult = $bestResult;
    }

    public function getOwner(): ?User
    {
        return $this->user;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function setBasic(bool $basic): void
    {
        $this->basic = $basic;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function setCards(array $cards): void
    {
        $this->cards = $cards;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->cards);
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): void
    {
        $this->completed = $completed;
    }
}
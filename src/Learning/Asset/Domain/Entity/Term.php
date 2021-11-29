<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Scandinaver\Core\Domain\Contract\UserInterface;

/**
 * Class Term
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
class Term
{
    private int $id;

    private string $value;

    private ?int $sentence;

    private int $isPublic;

    private ?string $morph;

    private ?float $frequency;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private ?UserInterface $creator;

    private Collection $translates;

    public function getValue(): string
    {
        return $this->value;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setSentence(?int $sentence): void
    {
        $this->sentence = $sentence;
    }

    public function setIsPublic(int $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function setCreator(UserInterface $creator): void
    {
        $this->creator = $creator;
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }

    public function getCreator(): ?UserInterface
    {
        return $this->creator;
    }

    /**
     * @return Collection | Translate[]
     */
    public function getTranslates(): Collection
    {
        return $this->translates;
    }

    public function addTranslate(Translate $translate): void
    {
        if (!$this->translates->contains($translate)) {
            $this->translates->add($translate);
            $translate->setTerm($this);
        }
    }

    public function getSentence(): ?int
    {
        return $this->sentence;
    }

    public function getIsPublic(): int
    {
        return $this->isPublic;
    }

    /**
     * @return array
     */
    public function toSearchableArray(): array
    {
        return [
            'value'        => $this->value,
            'is_sentence' => $this->sentence ?? 0,
        ];
    }

    /**
     * @return string
     */
    public function searchableAs(): string
    {
        return 'terms_index';
    }
}

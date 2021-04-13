<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Word
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Word
{
    private int $id;

    private string $word;

    private ?string $audio;

    private ?int $sentence;

    private int $isPublic;

    private ?string $morph;

    private ?float $frequency;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private ?User $creator;

    private Collection $translates;

    public function getValue(): string
    {
        return $this->word;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function setValue(string $word): void
    {
        $this->word = $word;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(?string $audio): void
    {
        $this->audio = $audio;
    }

    public function setSentence(?int $sentence): void
    {
        $this->sentence = $sentence;
    }

    public function setIsPublic(int $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }

    public function getCreator(): ?User
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
            $translate->setWord($this);
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
            'word'        => $this->word,
            'is_sentence' => $this->sentence ?? 0,
        ];
    }

    /**
     * @return string
     */
    public function searchableAs(): string
    {
        return 'words_index';
    }
}

<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Doctrine\Common\Collections\Collection;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Word
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Word implements UrlRoutable
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

    private $cards;

    private Collection $translates;

    public function getValue(): string
    {
        return $this->word;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection | Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'value' => $this->word,
            'audio' => $this->audio,
            'sentence' => $this->sentence,
            'is_public' => $this->isPublic,
            'creator' => $this->creator,
        ];
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
}

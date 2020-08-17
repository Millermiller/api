<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Collection;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Word
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Word implements JsonSerializable, UrlRoutable
{
    private $id;

    private string $word;

    private ?string $audio;

    private ?int $sentence;

    private int $isPublic;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $creator;

    private Language $language;

    private $cards;

    public function getValue(): string
    {
        return $this->word;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'word' => $this->word,
            'audio' => $this->audio,
            'sentence' => $this->sentence,
            'is_public' => $this->isPublic,
            'creator' => $this->creator,
            'language' => $this->language,
        ];
    }

    public function getWord(): string
    {
        return $this->word;
    }


    public function setWord(string $word): void
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

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }
}

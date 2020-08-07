<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Text
 *
 * @package Scandinaver\Translate\Domain\Model
 */
class Text implements JsonSerializable
{
    private int $id;

    private int $level;

    private string $title;

    private ?string $description;

    private string $text;

    private string $translate;

    private int $published;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private ?string $image = null;

    private $users;

    private Language $language;

    private $extra;

    private $words;

    private $textResults;

    private $synonyms;

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
     * @return Collection|User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'language' => $this->language,
            'level' => $this->level,
            'description' => $this->description,
            'text' => $this->text,
            'image' => $this->image,
            'count' => $this->words->count(),
            'extra' => $this->extra->toArray(),
            'synonyms' => $this->synonims,
        ];
    }

    public function setSynonyms(array $data): void
    {
        $this->synonyms = $data;
    }

    public function getLevel(): int
    {
        return $this->level;
    }
}

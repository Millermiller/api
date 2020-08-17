<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class Asset implements JsonSerializable, UrlRoutable
{
    public const TYPE_PERSONAL = 0;

    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_FAVORITES = 3;

    private $id;

    private string $title;

    private int $basic;

    private int $type;

    private int $level;

    private ?int $favorite;

    private DateTime $createdAt;

    private ?DateTime $updatedAt;

    private $users;

    private Language $language;

    private $cards;

    private $results;

    /**
     * Asset constructor.
     *
     * @param  string    $title
     * @param  int       $basic
     * @param  int       $type
     * @param  int|null  $favorite
     * @param  Language  $language
     */
    public function __construct(
        string $title,
        int $basic,
        int $type,
        ?int $favorite,
        Language $language
    ) {
        $this->title = $title;
        $this->basic = $basic;
        $this->type = $type;
        $this->favorite = $favorite;
        $this->language = $language;
        $this->users = new ArrayCollection();
        $this->results = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBasic(): int
    {
        return $this->basic;
    }

    /**
     * @param  int  $basic
     */
    public function setBasic(int $basic): void
    {
        $this->basic = $basic;
    }


    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function getFavorite(): ?int
    {
        return $this->favorite;
    }

    public function setFavorite(?int $favorite): void
    {
        $this->favorite = $favorite;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'level' => $this->level,
            'result' => $this->results->count() ? $this->results->toArray()[0]->getValue() : 0,
            'basic' => $this->basic,
            'language' => $this->language,
            'count' => $this->cards ? $this->cards->count() : 0,
            'cards' => [],
        ];
    }

    /**
     * @return int[]
     */
    public function getCardsIds(): array
    {
        return array_map(
            function ($card) {
                return $card->getId();
            },
            $this->cards->toArray()
        );
    }

    /**
     * @return int[]
     */
    public function getWordsIds(): array
    {
        return array_map(
            function ($card) {
                return $card->getWord()->getId();
            },
            $this->cards->toArray()
        );
    }
}

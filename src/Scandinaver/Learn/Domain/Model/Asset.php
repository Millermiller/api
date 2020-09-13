<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\AssetInterface;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
abstract class Asset implements JsonSerializable, UrlRoutable, AssetInterface
{
    public const TYPE_PERSONAL = 4;

    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_FAVORITES = 3;

    protected $id;

    protected string $title;

    protected int $basic;

    protected int $level;

    protected ?int $favorite;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    protected $users;

    protected Language $language;

    protected $cards;

    protected Collection $results;

    protected int $category;

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
        ?int $favorite,
        Language $language
    ) {
        $this->title = $title;
        $this->basic = $basic;
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

    public function addCard(Card $card): void
    {
        $this->cards->add($card);
    }

    public function removeCard(Card $card): void
    {
        $this->cards->removeElement($card);
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
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


    public function addResult(Result $result): void
    {
        if (!$this->results->contains($result)) {
            $this->results->add($result);
        }
    }
}

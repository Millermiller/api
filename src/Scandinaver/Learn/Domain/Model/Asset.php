<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\AssetInterface;
use Scandinaver\Learn\Domain\Events\AssetCreated;
use Scandinaver\Learn\Domain\Events\AssetDeleted;
use Scandinaver\Learn\Domain\Events\CardAddedToAsset;
use Scandinaver\Learn\Domain\Events\CardRemovedFromAsset;
use Scandinaver\Learn\Domain\Exceptions\CardAlreadyAddedException;
use Scandinaver\Shared\AggregateRoot;
use Scandinaver\User\Domain\Model\User;

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
abstract class Asset extends AggregateRoot implements UrlRoutable, AssetInterface
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

    protected ?User $owner;

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

        $this->pushEvent(new AssetCreated($this));
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

    /**
     * @param  Card  $card
     *
     * @throws CardAlreadyAddedException
     */
    public function addCard(Card $card): void
    {
        if ($this->cards->contains($card)) {
            throw new CardAlreadyAddedException('Карточка уже добавлена');
        }

        $this->cards->add($card);
        $this->pushEvent(new CardAddedToAsset($this, $card));
    }


    public function removeCard(Card $card): void
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
            $this->pushEvent(new CardRemovedFromAsset($this, $card));
        }
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

    public function toDTO(): AssetDTO
    {
        return new AssetDTO($this);
    }

    public function delete()
    {
        $this->pushEvent(new AssetDeleted($this));
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}

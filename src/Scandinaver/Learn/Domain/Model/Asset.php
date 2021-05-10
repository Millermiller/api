<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Learn\Domain\Contract\AssetInterface;
use Scandinaver\Learn\Domain\Event\AssetCreated;
use Scandinaver\Learn\Domain\Event\AssetDeleted;
use Scandinaver\Learn\Domain\Event\CardAddedToAsset;
use Scandinaver\Learn\Domain\Event\CardRemovedFromAsset;
use Scandinaver\Learn\Domain\Exception\CardAlreadyAddedException;
use Scandinaver\Shared\AggregateRoot;

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Model
 */
abstract class Asset extends AggregateRoot implements UrlRoutable, AssetInterface
{
    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_PERSONAL = 3;

    public const TYPE_FAVORITES = 4;

    protected ?int $id;

    protected string $title;

    protected int $basic;

    protected int $level;

    protected ?int $favorite;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    protected Language $language;

    protected Collection $cards;

    protected Collection $passings;

    protected int $category;

    protected ?UserInterface $owner;

    private ?Passing $bestResult = NULL;

    private bool $active = FALSE;

    private bool $available = FALSE;

    private bool $completed = FALSE;

    /**
     * Asset constructor.
     *
     * @param  string    $title
     * @param  int       $basic
     * @param  int|null  $favorite
     * @param  Language  $language
     */
    public function __construct(
        string $title,
        int $basic,
        ?int $favorite,
        Language $language
    ) {
        $this->title    = $title;
        $this->basic    = $basic;
        $this->favorite = $favorite;
        $this->language = $language;
        $this->passings = new ArrayCollection();
        $this->cards    = new ArrayCollection();

        $this->pushEvent(new AssetCreated($this));
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
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


    public function addPassing(Passing $result): void
    {
        if (!$this->passings->contains($result)) {
            $this->passings->add($result);
        }
    }

    public function onDelete()
    {
        $this->pushEvent(new AssetDeleted($this));
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function isFavorite(): bool
    {
        return $this->favorite === 1;
    }

    public function getOwner(): ?UserInterface
    {
        return $this->owner;
    }

    public function setOwner(?UserInterface $owner): void
    {
        $this->owner = $owner;
    }

    public function isCompletedByUser(UserInterface $user): bool
    {
        /** @var Passing $passing */
        foreach ($this->passings as $passing) {
            if ($passing->getUser()->isEqualTo($user) && $passing->isCompleted()) {
                return TRUE;
            }
        }

        return FALSE;
    }

    public function getBestResultForUser(UserInterface $user): ?Passing
    {
        $bestResult = NULL;

        /** @var Passing $passing */
        foreach ($this->passings as $passing) {
            if (!$passing->getUser()->isEqualTo($user)) {
                continue;
            }
            if (NULL === $bestResult) {
                $bestResult = $passing;
            }
            if ($bestResult->getPercent() < $passing->getPercent()) {
                $bestResult = $passing;
            }
        }

        return $bestResult;
    }

    public function isFirstAsset(): bool
    {
        return $this->level === 1;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getCount(): int
    {
        return $this->cards->count();
    }

    public function getBestResult(): ?Passing
    {
        return $this->bestResult;
    }

    public function setBestResult(?Passing $bestResult): void
    {
        $this->bestResult = $bestResult;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
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

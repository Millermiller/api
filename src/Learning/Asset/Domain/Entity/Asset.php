<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Core\Domain\Contract\LearnItemInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\AbstractLearnItem;
use Scandinaver\Common\Domain\Entity\HasLevel;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\AssetInterface;
use Scandinaver\Learning\Asset\Domain\Event\AssetCreated;
use Scandinaver\Learning\Asset\Domain\Event\AssetDeleted;
use Scandinaver\Learning\Asset\Domain\Event\CardAddedToAsset;
use Scandinaver\Learning\Asset\Domain\Event\CardRemovedFromAsset;
use Scandinaver\Learning\Asset\Domain\Exception\CardAlreadyAddedException;

/**
 * Class Asset
 *
 * @package Scandinaver\Learn\Domain\Entity
 */
abstract class Asset extends AbstractLearnItem implements UrlRoutable, AssetInterface, LearnItemInterface
{
    use HasLevel;

    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_PERSONAL = 3;

    public const TYPE_FAVORITES = 4;

    protected ?int $id;

    protected string $title;

    protected int $type;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    protected Language $language;

    /** @var Collection<int, Card>|Card[]  */
    protected Collection $cards;

    protected int $category;

    protected ?UserInterface $owner;

    /**
     * Asset constructor.
     *
     * @param  string    $title
     * @param  Language  $language
     */
    public function __construct(
        string $title,
        Language $language
    ) {
        $this->title    = $title;
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

    public function setType(int $type): void
    {
        $this->type = $type;
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
    public function getTermsIds(): array
    {
        return array_map(
            function ($card) {
                /** @var Card $card*/
                return $card->getTerm()->getId();
            },
            $this->cards->toArray()
        );
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
        return $this->getType() === Asset::TYPE_FAVORITES;
    }

    public function getOwner(): ?UserInterface
    {
        return $this->owner;
    }

    public function setOwner(?UserInterface $owner): void
    {
        $this->owner = $owner;
    }

    public function setLanguage(Language $language): void
    {
        $this->language = $language;
    }

    public function getCount(): int
    {
        return $this->cards->count();
    }
}

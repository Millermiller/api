<?php


namespace Scandinaver\Learning\Asset\Domain\Entity;

use DateTime;
use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Scandinaver\Core\Domain\Contract\LearnItemInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Common\Domain\Entity\AbstractLearnItem;
use Scandinaver\Common\Domain\Entity\HasLevel;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Learning\Asset\Domain\Contract\AssetInterface;
use Scandinaver\Learning\Asset\Domain\Enum\AssetType;
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
abstract class Asset extends AbstractLearnItem implements AssetInterface, LearnItemInterface
{
    use HasLevel;

    protected ?UuidInterface $id = NULL;

    protected string $title;

    protected AssetType $type;

    protected DateTime $createdAt;

    protected ?DateTime $updatedAt;

    protected Language $language;

    /** @var Card[]|Collection<int, Card> */
    protected Collection|array $cards;

    protected int $category;

    protected ?UserInterface $owner;

    protected ?array $sorting = NULL;

    public function __construct(string $title, Language $language)
    {
        $this->title    = $title;
        $this->language = $language;
        $this->passings = new ArrayCollection();
        $this->cards    = new ArrayCollection();
        $this->sorting  = [];
        $this->category = $this->type->value;
        $this->pushEvent(new AssetCreated($this));
    }

    public function getId(): UuidInterface
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getCards(): Collection
    {
        $sorting = $this->sorting;
        if ($sorting !== NULL) {
            $sortedCollection = new ArrayCollection();
            foreach ($sorting as $id) {
                $card = $this->cards->filter(fn($item) => $item->getId() === (int) $id)->first();
                $sortedCollection->add($card);
            }

            $this->cards = $sortedCollection;
        }
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
            throw new CardAlreadyAddedException();
        }

        $this->cards->add($card);

        if ($this->sorting === NULL) {
            $this->sorting = [$card->getId()];
        } else {
            $this->sorting[] = $card->getId();
        }

        $this->pushEvent(new CardAddedToAsset($this, $card));
    }


    public function removeCard(Card $card): void
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
            if (($key = array_search($card->getId(), $this->sorting)) !== FALSE) {
                unset($this->sorting[$key]);
            }
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
        return $this->getType() === AssetType::FAVORITES;
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

    public function getSorting(): ?array
    {
        return $this->sorting;
    }

    public function setSorting(?array $sorting): void
    {
        $this->sorting = array_map(fn($item) => (int)$item, $sorting);
    }
}

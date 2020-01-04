<?php

namespace  App\Entities;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * Assets
 *
 * @ORM\Table(name="assets", indexes={@ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Asset implements JsonSerializable, UrlRoutable
{
    const TYPE_PERSONAL = 0;
    const TYPE_WORDS = 1;
    const TYPE_SENTENCES = 2;
    const TYPE_FAVORITES = 3;

    /**
     * Asset constructor.
     * @param string $title
     * @param int $basic
     * @param int $type
     * @param int|null $favorite
     * @param string $language_id
     */
    public function __construct(string $title, int $basic, int $type, ?int $favorite, Language $language)
    {
        $this->title = $title;
        $this->basic = $basic;
        $this->type = $type;
        $this->favorite = $favorite;
        $this->language = $language;
        $this->users = New ArrayCollection();
        $this->results = New ArrayCollection();
        $this->cards = New ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="basic", type="integer", nullable=false)
     */
    private $basic;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = 1;

    /**
     * @var int|null
     *
     * @ORM\Column(name="favorite", type="integer", nullable=true)
     */
    private $favorite;

    /**
     * @var int
     *
     * @ORM\Column(name="language_id", type="integer", length=50)
     */
    private $languageId;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Collection|User[]
     *
     * @ManyToMany(targetEntity="User", mappedBy="assets")
     */
    private $users;

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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getBasic(): int
    {
        return $this->basic;
    }

    /**
     * @param int $basic
     */
    public function setBasic(int $basic): void
    {
        $this->basic = $basic;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return int|null
     */
    public function getFavorite(): ?int
    {
        return $this->favorite;
    }

    /**
     * @param int|null $favorite
     */
    public function setFavorite(?int $favorite): void
    {
        $this->favorite = $favorite;
    }

    /**
     * @return string|null
     */
    public function getLang(): ?string
    {
        return $this->languageId;
    }

    /**
     * @param string|null $lang
     */
    public function setLang(?string $language_id): void
    {
        $this->languageId = $language_id;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="assets")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @var Collection|Card[]
     *
     * @ORM\OneToMany(targetEntity="Card", mappedBy="asset", cascade="remove", fetch="EAGER")
     *
     */
    private $cards;

    /**
     * @var Collection|Result[]
     *
     * @ORM\OneToMany(targetEntity="Result", mappedBy="asset", cascade="remove")
     *
     */
    private $results;

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
        return array(
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'level' => $this->level,
            'result' => $this->results->count() ?  $this->results->toArray()[0]->getValue() : 0,
            'basic' => $this->basic,
            'language_id' => $this->languageId,
            'count' => $this->cards ? $this->cards->count() : 0,
            'cards' => [],
        );
    }

    /**
     * @return array
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
     * @return array
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

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * @param User $user
     */
    public function addUser($user): void
    {
        $user->getAssets()->add($this);
        $this->users->add($user);
    }
}

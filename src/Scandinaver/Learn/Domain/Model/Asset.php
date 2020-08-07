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
 * Assets
 * @ORM\Table(name="asset", indexes={@ORM\Index(name="id", columns={"id"})})
 *
 * @ORM\Entity
 */
class Asset implements JsonSerializable, UrlRoutable
{
    public const TYPE_PERSONAL = 0;

    public const TYPE_WORDS = 1;

    public const TYPE_SENTENCES = 2;

    public const TYPE_FAVORITES = 3;

    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(name="basic", type="integer", nullable=false)
     */
    private int $basic;

    /**
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private int $type;

    /**
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private int $level;

    /**
     * @ORM\Column(name="favorite", type="integer", nullable=true)
     */
    private ?int $favorite;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private ?DateTime $updatedAt;

    /**
     * @var Collection|User[]
     * @ManyToMany(targetEntity="Scandinaver\User\Domain\Model\User", mappedBy="assets")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", inversedBy="assets")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private Language $language;

    /**
     * @var Collection|Card[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Model\Card", mappedBy="asset",
     *   cascade="remove", fetch="EAGER")
     */
    private $cards;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Model\Result", mappedBy="asset",
     *   cascade="remove")
     */
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

    /**
     * @return string
     */
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
     * @param  string  $title
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
     * @param  int  $basic
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
     * @param  int  $type
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
     * @param  int  $level
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
     * @param  int|null  $favorite
     */
    public function setFavorite(?int $favorite): void
    {
        $this->favorite = $favorite;
    }

    /**
     * @return DateTime|null
     */
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

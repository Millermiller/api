<?php

namespace  App\Entities;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * Assets
 *
 * @ORM\Table(name="assets", indexes={@ORM\Index(name="lang", columns={"lang"})})
 * @ORM\Entity
 */
class Asset
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
     * @param string|null $lang
     */
    public function __construct(string $title, int $basic, int $type, ?int $favorite, ?string $lang)
    {
        $this->title = $title;
        $this->basic = $basic;
        $this->type = $type;
        $this->favorite = $favorite;
        $this->lang = $lang;
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
    private $type = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="favorite", type="integer", nullable=true)
     */
    private $favorite = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="lang", type="string", length=50, nullable=true)
     */
    private $lang;

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
        return $this->lang;
    }

    /**
     * @param string|null $lang
     */
    public function setLang(?string $lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }
}

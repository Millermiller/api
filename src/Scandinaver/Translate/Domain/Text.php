<?php


namespace Scandinaver\Translate\Domain;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\Common\Domain\Language;
use Scandinaver\User\Domain\User;

/**
 * Text
 * @ORM\Table(name="text", indexes={@ORM\Index(name="lang", columns={"lang"}), @ORM\Index(name="title", columns={"title"})})
 *
 * @ORM\Entity
 */
class Text implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(name="language_id", type="string", length=50, nullable=true)
     */
    private $languageId;

    /**
     * @var int|null
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private $text;

    /**
     * @var string
     * @ORM\Column(name="translate", type="text", length=65535, nullable=false)
     */
    private $translate;

    /**
     * @var int|null
     * @ORM\Column(name="published", type="integer", nullable=true)
     */
    private $published = '0';

    /**
     * @var DateTime|null
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var string|null
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var Collection|User[]
     * @ORM\ManytoMany(targetEntity="Scandinaver\User\Domain\User", mappedBy="texts")
     */
    private $users;

    /**
     * @var Language
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Language", inversedBy="texts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;

    /**
     * @var Collection|TextExtra[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\TextExtra", mappedBy="text")
     */
    private $extra;

    /**
     * @var Collection|Word[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Word", mappedBy="text")
     */
    private $words;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Result", mappedBy="text", cascade="remove")
     */
    private $textResults;

    /**
     * @var array
     */
    private $synonims;

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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
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
            'id'          => $this->id,
            'language'    => $this->language,
            'level'       => $this->level,
            'description' => $this->description,
            'text'        => $this->text,
            'image'       => $this->image,
            'count'       => $this->words->count(),
            'extra'       => $this->extra->toArray(),
            'synonyms'    => $this->synonims,
        ];
    }

    public function setSynonims(array $data): void
    {
        $this->synonims = $data;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }
}

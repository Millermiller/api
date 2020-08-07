<?php


namespace Scandinaver\Translate\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\User\Domain\Model\User;

/**
 * Text
 * @ORM\Table(name="text", indexes={
 *     @ORM\Index(name="language_id", columns={"language_id"}),
 *     @ORM\Index(name="title", columns={"title"})
 * })
 *
 * @ORM\Entity
 */
class Text implements JsonSerializable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private int $level;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private string $title;

    /**
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(name="text", type="text", length=65535, nullable=false)
     */
    private string $text;

    /**
     * @ORM\Column(name="translate", type="text", length=65535, nullable=false)
     */
    private string $translate;

    /**
     * @ORM\Column(name="published", type="integer", nullable=false)
     */
    private int $published;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private ?string $image = null;

    /**
     * @var Collection|User[]
     * @ORM\ManytoMany(targetEntity="Scandinaver\User\Domain\Model\User", mappedBy="texts")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Common\Domain\Model\Language", inversedBy="texts")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private Language $language;

    /**
     * @var Collection|TextExtra[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Model\TextExtra", mappedBy="text")
     */
    private $extra;

    /**
     * @var Collection|Word[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Model\Word", mappedBy="text")
     */
    private $words;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Model\Result", mappedBy="text",
     *   cascade="remove")
     */
    private $textResults;

    private array $synonyms;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): void
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
            'id' => $this->id,
            'language' => $this->language,
            'level' => $this->level,
            'description' => $this->description,
            'text' => $this->text,
            'image' => $this->image,
            'count' => $this->words->count(),
            'extra' => $this->extra->toArray(),
            'synonyms' => $this->synonims,
        ];
    }

    public function setSynonyms(array $data): void
    {
        $this->synonyms = $data;
    }

    public function getLevel(): int
    {
        return $this->level;
    }
}

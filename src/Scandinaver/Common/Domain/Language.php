<?php


namespace Scandinaver\Common\Domain;

use Doctrine\Common\Collections\{ArrayCollection, Collection};
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;
use Scandinaver\Blog\Domain\Post;
use Scandinaver\Learn\Domain\{Asset, Result};
use Scandinaver\Translate\Domain\Text;

/**
 * Languages
 * @ORM\Table(name="languages", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="id", columns={"id"})})
 *
 * @ORM\Entity
 */
class Language implements JsonSerializable, UrlRoutable
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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(name="label", type="string", length=50, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     * @ORM\Column(name="flag", type="string", length=50, nullable=true)
     */
    private $flag;

    /**
     * @var Collection|Asset[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Asset", mappedBy="language")
     */
    private $assets;

    /**
     * @var Collection|Text[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Translate\Domain\Text", mappedBy="language")
     */
    private $texts;

    /**
     * @var Collection|Post[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Blog\Domain\Post", mappedBy="language")
     */
    private $posts;

    /**
     * @var Collection|Result[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Result", mappedBy="language")
     */
    private $results;

    public function __construct(int $id, string $name)
    {
        $this->id     = $id;
        $this->name   = $name;
        $this->assets = new ArrayCollection();
        $this->cards  = new ArrayCollection();
    }

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'name';
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }

    /**
     * @param string|null $flag
     */
    public function setFlag(?string $flag): void
    {
        $this->flag = $flag;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return [
            'name'   => $this->label,
            'label'  => $this->label,
            'flag'   => config('app.SITE') . $this->flag,
            'letter' => $this->name,
            'cards'  => $this->getCards()->count(),
            'value'  => 'https://' . $this->name . '.' . config('app.DOMAIN')
        ];
    }

    /**
     * @return ArrayCollection
     */
    public function getCards()
    {
        $cardsCollection = new ArrayCollection();

        foreach ($this->assets as $asset) {
            foreach ($asset->getCards() as $card) {
                $cardsCollection->add($card);
            }
        }

        return $cardsCollection;
    }

    public function getAssets()
    {
        return $this->assets;
    }
}

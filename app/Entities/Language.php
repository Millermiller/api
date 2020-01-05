<?php

namespace  App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Languages
 *
 * @ORM\Table(name="languages", indexes={@ORM\Index(name="name", columns={"name"}), @ORM\Index(name="id", columns={"id"})})
 * @ORM\Entity
 */
class Language implements JsonSerializable
{
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->assets = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    /**
     * @param string|null $flag
     */
    public function setFlag(?string $flag): void
    {
        $this->flag = $flag;
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
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getFlag(): ?string
    {
        return $this->flag;
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
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=50, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="flag", type="string", length=50, nullable=true)
     */
    private $flag;

    /**
     * @var Collection|Asset[]
     *
     * @ORM\OneToMany(targetEntity="Asset", mappedBy="language")
     */
    private $assets;

    /**
     * @var Collection|Text[]
     *
     * @ORM\OneToMany(targetEntity="Scandinaver\Text\Domain\Text", mappedBy="language")
     */
    private $texts;

    /**
     * @var Collection|Post[]
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="language")
     */
    private $posts;

    /**
     * @var Collection|Result[]
     *
     * @ORM\OneToMany(targetEntity="Result", mappedBy="language")
     */
    private $results;

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return array(
            'name' => $this->label,
            'label' => $this->label,
            'flag'=> config('app.SITE').$this->flag,
            'letter'=> $this->name,
            'cards' => $this->getCards()->count(),
            'value' => 'https://'.$this->name.'.'.config('app.DOMAIN')
        );
    }

    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @return ArrayCollection
     */
    public function getCards()
    {
        $cardsCollection = new ArrayCollection();

        foreach($this->assets as $asset){
            foreach($asset->getCards() as $card){
                $cardsCollection->add($card);
            }
        }

        return $cardsCollection;
    }
}

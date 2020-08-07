<?php


namespace Scandinaver\Learn\Domain\Model;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * Cards
 * @ORM\Table(name="card", indexes={@ORM\Index(name="word_id", columns={"word_id"}), @ORM\Index(name="translate_id", columns={"translate_id"}), @ORM\Index(name="asset_id", columns={"asset_id"})})
 *
 * @ORM\Entity
 */
class Card implements JsonSerializable, UrlRoutable
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private DateTime $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Word", inversedBy="cards")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     */
    private Word $word;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Asset", inversedBy="cards")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private Asset $asset;

    /**
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Model\Translate")
     * @ORM\JoinColumn(name="translate_id", referencedColumnName="id")
     */
    private Translate $translate;

    /**
     * @var Collection|Example[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Model\Example", mappedBy="card")
     */
    private $examples;

    private $favourite;

    /**
     * Card constructor.
     *
     * @param  Word       $word
     * @param  Asset      $asset
     * @param  Translate  $translate
     */
    public function __construct(Word $word, Asset $asset, Translate $translate)
    {
        $this->word = $word;
        $this->asset = $asset;
        $this->translate = $translate;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function getWord(): Word
    {
        return $this->word;
    }

    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    public function getAsset(): Asset
    {
        return $this->asset;
    }

    public function setAsset(Asset $asset): void
    {
        $this->asset = $asset;
    }

    public function getTranslate(): Translate
    {
        return $this->translate;
    }

    public function setTranslate(Translate $translate): void
    {
        $this->translate = $translate;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'asset_id' => $this->asset->getId(),
            'word_id' => $this->word->getId(),
            'translate_id' => $this->translate->getId(),
            'favourite' => $this->favourite,
            'word' => $this->word,
            'translate' => $this->translate,
            'asset' => $this->asset,
            'examples' => $this->examples,
        ];
    }

    /**
     * @return Example[]|Collection
     */
    public function getExamples()
    {
        return $this->examples->toArray();
    }

    /**
     * @return bool
     */
    public function isFavourite(): bool
    {
        return (bool) $this->asset->getFavorite();
    }

    /**
     * @param  mixed  $favourite
     */
    public function setFavourite($favourite): void
    {
        $this->favourite = $favourite;
    }

    /**
     * @return string
     */
    public static function getRouteKeyName(): string
    {
        return 'id';
    }
}

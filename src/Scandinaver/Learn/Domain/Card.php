<?php


namespace Scandinaver\Learn\Domain;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Cards
 * @ORM\Table(name="cards", indexes={@ORM\Index(name="word_id", columns={"word_id"}), @ORM\Index(name="translate_id", columns={"translate_id"}), @ORM\Index(name="asset_id", columns={"asset_id"})})
 *
 * @ORM\Entity
 */
class Card implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="asset_id", type="integer", nullable=false)
     */
    private $assetId;

    /**
     * @var int
     * @ORM\Column(name="word_id", type="integer", nullable=false)
     */
    private $wordId;

    /**
     * @var int
     * @ORM\Column(name="translate_id", type="integer", nullable=false)
     */
    private $translateId;

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
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var Word
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Word", inversedBy="cards")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     */
    private $word;

    /**
     * @var Asset
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Asset", inversedBy="cards")
     * @ORM\JoinColumn(name="asset_id", referencedColumnName="id")
     */
    private $asset;

    /**
     * @var Translate
     * @ORM\ManyToOne(targetEntity="Scandinaver\Learn\Domain\Translate")
     * @ORM\JoinColumn(name="translate_id", referencedColumnName="id")
     */
    private $translate;

    /**
     * @var Collection|Example[]
     * @ORM\OneToMany(targetEntity="Scandinaver\Learn\Domain\Example", mappedBy="card")
     */
    private $examples;

    private $favourite;

    /**
     * Card constructor.
     *
     * @param Word      $word
     * @param Asset     $asset
     * @param Translate $translate
     */
    public function __construct(Word $word, Asset $asset, Translate $translate)
    {
        $this->word      = $word;
        $this->asset     = $asset;
        $this->translate = $translate;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * @param Word $word
     */
    public function setWord(Word $word): void
    {
        $this->word = $word;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @param Asset $asset
     */
    public function setAsset(Asset $asset): void
    {
        $this->asset = $asset;
    }

    /**
     * @return Translate
     */
    public function getTranslate(): Translate
    {
        return $this->translate;
    }

    /**
     * @param Translate $translate
     */
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
            'id'           => $this->id,
            'asset_id'     => $this->assetId,
            'word_id'      => $this->wordId,
            'translate_id' => $this->translateId,
            'favourite'    => $this->favourite,
            'word'         => $this->word,
            'translate'    => $this->translate,
            'asset'        => $this->asset,
            'examples'     => $this->examples,
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
        return (bool)$this->asset->getFavorite();
    }

    /**
     * @param mixed $favourite
     */
    public function setFavourite($favourite): void
    {
        $this->favourite = $favourite;
    }

    /**
     * @param int $assetId
     */
    public function setAssetId(int $assetId): void
    {
        $this->assetId = $assetId;
    }
}

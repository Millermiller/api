<?php

use LaravelDoctrine\ORM\Contracts\UrlRoutable;

/**
 * Class CardEntity
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class CardEntity implements JsonSerializable, UrlRoutable
{
    private $id;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private Word $word;

    private $asset;

    // TODO: need to remove. used in favourites
    private $wordId;
    private $assetId;

    private Translate $translate;

    private $examples;

    private $favourite;

    /**
     * CardEntity constructor.
     *
     * @param  Word       $word
     * @param  Asset      $asset
     * @param  Translate  $translate
     */
    public function __construct(Word $word, ?Asset $asset, Translate $translate)
    {
        $this->word      = $word;
        $this->asset     = $asset;
        $this->translate = $translate;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

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
            'id'           => $this->id,
            // 'asset_id' => $this->asset->getId(),
            'word_id'      => $this->word->getId(),
            'translate_id' => $this->translate->getId(),
            'favourite'    => $this->favourite,
            'word'         => $this->word,
            'translate'    => $this->translate,
            'asset'        => $this->asset,
            'examples'     => $this->examples,
        ];
    }

    /**
     * @return Example[]
     */
    public function getExamples()
    {
        return $this->examples->toArray();
    }

    public function isFavourite(): bool
    {
        return (bool)$this->asset->getFavorite();
    }

    public function setFavourite(bool $favourite): void
    {
        $this->favourite = $favourite;
    }

    public static function getRouteKeyName(): string
    {
        return 'id';
    }
}

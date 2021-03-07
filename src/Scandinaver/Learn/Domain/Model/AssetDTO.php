<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class AssetDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class AssetDTO extends DTO
{

    private Asset $asset;

    private bool $active = FALSE;

    private bool $available = FALSE;

    private ?Result $bestResult = NULL;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function setAvailable(bool $available): void
    {
        $this->available = $available;
    }

    public function setBestResult(?Result $bestResult): void
    {
        $this->bestResult = $bestResult;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'         => $this->asset->getId(),
            'title'      => $this->asset->getTitle(),
            'level'      => $this->asset->getLevel(),
            'basic'      => $this->asset->getBasic(),
            'bestResult' => $this->bestResult ? $this->bestResult->getPercent() : 0,
            'language'   => $this->asset->getLanguage()->toDTO(),
            'count'      => $this->asset->getCards() ? $this->asset->getCards()->count() : 0,
            'cards'      => [],
            'result'     => 0, // TODO: implement
            'type'       => $this->asset->getType(),
            'active'     => $this->active,
            'available'  => $this->available,
        ];
    }
}
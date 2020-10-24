<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Shared\DTO;

class AssetDTO extends DTO
{

    private Asset $asset;

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->asset->getId(),
            'title' => $this->asset->getTitle(),
            'level' => $this->asset->getLevel(),
          //  'result' => $this->asset->->count() ? $this->results->toArray()[0]->getValue() : 0,
            'basic' => $this->asset->getBasic(),
            'language' => $this->asset->getLanguage()->toDTO(),
            'count' => $this->asset->getCards() ? $this->asset->getCards()->count() : 0,
            'cards' => [],
        ];
    }
}
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

    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'       => $this->asset->getId(),
            'title'    => $this->asset->getTitle(),
            'level'    => $this->asset->getLevel(),
            //  'result' => $this->asset->->count() ? $this->results->toArray()[0]->getValue() : 0,
            'basic'    => $this->asset->getBasic(),
            'language' => $this->asset->getLanguage()->toDTO(),
            'count'    => $this->asset->getCards() ? $this->asset->getCards()->count() : 0,
            'cards'    => [],
            'result'   => 0, // TODO: implement
            'type'     => $this->asset->getType()
        ];
    }
}
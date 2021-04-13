<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resources\LanguageTransformer;
use Scandinaver\Learn\Domain\DTO\AssetDTO;

/**
 * Class AssetTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
 */
class AssetDTOTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'cards',
        'active',
        'available',
        'completed',
    ];

    protected $defaultIncludes = [
        'bestResult',
        'language'
    ];

    public function transform(AssetDTO $assetDTO): array
    {
        return [
            'id'         => $assetDTO->getId(),
            'type'       => $assetDTO->getType(),
            'title'      => $assetDTO->getTitle(),
            'level'      => $assetDTO->getLevel(),
            'count'      => $assetDTO->getCount(),
            'basic'      => $assetDTO->isBasic(),
            'bestResult' => $assetDTO->getBestResult(),
        ];
    }

    public function includeCards(AssetDTO $assetDTO): Collection
    {
        $cards = $assetDTO->getCards();

        return $this->collection($cards, new CardDTOTransformer());
    }

    public function includeBestResult(AssetDTO $assetDTO): Primitive
    {
        $passing = $assetDTO->getBestResult();

        return $this->primitive($passing ? $passing->getPercent() : NULL);
    }

    public function includeCompleted(AssetDTO $assetDTO): Primitive
    {
        return $this->primitive($assetDTO->isCompleted());
    }

    public function includeActive(AssetDTO $assetDTO): Primitive
    {
        return $this->primitive($assetDTO->isActive());
    }

    public function includeAvailable(AssetDTO $assetDTO): Primitive
    {
        return $this->primitive($assetDTO->isAvailable());
    }

    public function includeLanguage(AssetDTO $assetDTO): Item
    {
        $language = $assetDTO->getLanguage();

        return $this->item($language, new LanguageTransformer());
    }
}
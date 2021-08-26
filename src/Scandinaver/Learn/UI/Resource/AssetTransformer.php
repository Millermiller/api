<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Learn\Domain\Entity\Asset;

/**
 * Class AssetTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class AssetTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'cards',
        'active',
        'available',
        'completed',
    ];

    protected $defaultIncludes = [
        'language',
        'bestResult'
    ];

    /**
     * @param  Asset  $asset
     *
     * @return array
     */
    public function transform(Asset $asset): array
    {
        return [
            'id'    => $asset->getId(),
            'type'  => $asset->getType(),
            'title' => $asset->getTitle(),
            'level' => $asset->getLevel(),
            'count' => $asset->getCount(),
        ];
    }

    public function includeCards(Asset $asset): Collection
    {
        $cards = $asset->getCards();

        return $this->collection($cards, new CardTransformer());
    }

    public function includeLanguage(Asset $asset): Item
    {
        $language = $asset->getLanguage();

        return $this->item($language, new LanguageTransformer());
    }

    public function includeCompleted(Asset $asset): Primitive
    {
        return $this->primitive($asset->isCompleted());
    }

    public function includeActive(Asset $asset): Primitive
    {
        return $this->primitive($asset->isActive());
    }

    public function includeAvailable(Asset $asset): Primitive
    {
        return $this->primitive($asset->isAvailable());
    }

    public function includeBestResult(Asset $asset): Primitive
    {
        $bestResult = $asset->getBestResult();

        if ($bestResult === NULL) {
            return $this->primitive(0);
        }
        return $this->primitive($bestResult->getPercent());
    }
}
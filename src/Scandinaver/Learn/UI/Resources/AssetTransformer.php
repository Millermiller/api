<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resources\LanguageTransformer;
use Scandinaver\Learn\Domain\Model\Asset;

/**
 * Class AssetTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
 */
class AssetTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'cards',
    ];

    protected $defaultIncludes = [
        'language'
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
            'basic' => $asset->getBasic(),
            'count' => $asset->getCount()
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
}
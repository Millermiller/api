<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Learning\Asset\Domain\Entity\Asset;

/**
 * Class AssetTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class AssetTransformer extends TransformerAbstract
{

    protected array $availableIncludes = [
        'cards',
        'active',
        'available',
        'completed',
    ];

    protected array $defaultIncludes = [
        'language',
       // 'bestResult', //TODO: think about optional includes
    ];

    #[ArrayShape([
        'id'         => "int",
        'category'   => "int",
        'title'      => "string",
        'level'      => "int",
        'count'      => "int",
        'sorting'    => "string",
        'active'     => "string",
        'available'  => "string",
        'completed'  => "string",
        'result'     => "int",
    ])]
    public function transform(Asset $asset): array
    {
        return [
            'id'         => $asset->getId(),
            'category'   => $asset->getType()->value,
            'title'      => $asset->getTitle(),
            'level'      => $asset->getLevel(),
            'count'      => $asset->getCount(),
            'sorting'    => $asset->getSorting(),
            'active'     => $asset->isActive(),
            'available'  => $asset->isAvailable(),
            'completed'  => $asset->isCompleted(),
            'result'     => $asset->getBestResult()?->getPercent(),
        ];
    }

    public function includeCards(Asset $asset): Collection
    {
        $cards = $asset->getCards();

        return $this->collection($cards, new CardTransformer(), 'cards');
    }

    public function includeLanguage(Asset $asset): Item
    {
        $language = $asset->getLanguage();

        return $this->item($language, new LanguageTransformer(), 'language');
    }

    public function includeCompleted(Asset $asset): Primitive
    {
        return $this->primitive($asset->isCompleted());
    }

    public function includeActive(Asset $asset): Primitive
    {
        return $this->primitive($asset->isActive(), NULL, 'active');
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
<?php

namespace Scandinaver\Statistic\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Statistic\Domain\Entity\Item as StatisticItem;
use Scandinaver\User\UI\Resource\UserTransformer;

/**
 * Class StatisticTransformer
 *
 * @package Scandinaver\Statistic\UI\Resource
 */
class StatisticTransformer extends TransformerAbstract
{

    protected array $defaultIncludes = [
        'user',
        'language',
    ];

    #[ArrayShape([
        'id'        => "int|null",
        'category'  => "\Scandinaver\Statistic\Domain\Enum\StatisticType",
        'data'      => "array|null",
        'createdAt' => "string",
    ])]
    public function transform(StatisticItem $item): array
    {
        return [
            'id'        => $item->getId(),
            'category'  => $item->getType(), // we can't use "type" because incorrect parsed in vue
            'data'      => $item->getData(),
            'createdAt' => $item->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public function includeUser(StatisticItem $item): Item
    {
        $user = $item->getUser();

        return $this->item($user, new UserTransformer(), 'user');
    }

    public function includeLanguage(StatisticItem $item): Item
    {
        $language = $item->getLanguage();

        return $this->item($language, new LanguageTransformer(), 'language');
    }
}
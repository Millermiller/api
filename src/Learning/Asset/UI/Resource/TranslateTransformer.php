<?php


namespace Scandinaver\Learning\Asset\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learning\Asset\Domain\Entity\Translate;

/**
 * Class TranslateTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class TranslateTransformer extends TransformerAbstract
{
    /**
     * @param  Translate  $translate
     *
     * @return array
     */
    public function transform(Translate $translate): array
    {
        return [
            'id'    => $translate->getId(),
            'value' => $translate->getValue(),
        ];
    }
}
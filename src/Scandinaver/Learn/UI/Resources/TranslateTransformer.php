<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Translate;

/**
 * Class TranslateTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
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
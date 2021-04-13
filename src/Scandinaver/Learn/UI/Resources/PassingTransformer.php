<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Passing;

/**
 * Class PassingTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
 */
class PassingTransformer extends TransformerAbstract
{
    /**
     * @param  Passing  $passing
     *
     * @return array
     */
    public function transform(Passing $passing)
    {
        return [
            'value' => $passing->getPercent(),
        ];
    }
}
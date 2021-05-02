<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\Model\Passing;

/**
 * Class PassingTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
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
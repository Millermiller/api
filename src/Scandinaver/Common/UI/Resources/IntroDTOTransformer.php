<?php


namespace Scandinaver\Common\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\DTO\IntroDTO;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resources
 */
class IntroDTOTransformer extends TransformerAbstract
{
    public function transform(IntroDTO $introDTO): array
    {
        return [
            'id'           => $introDTO->getId(),
            'page'         => $introDTO->getPage(),
            'target'       => $introDTO->getTarget(),
            'content'      => $introDTO->getContent(),
            'position'     => $introDTO->getPosition(),
            'tooltipClass' => $introDTO->getTooltipClass(),
            'sort'         => $introDTO->getSort(),
        ];
    }
}
<?php


namespace Scandinaver\Common\UI\Resource;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Entity\Intro;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class IntroTransformer extends TransformerAbstract
{

    #[Pure]
    #[ArrayShape([
        'id'         => "int",
        'page'       => "string",
        'target'     => "null|string",
        'content'    => "null|string",
        'position'   => "null|string",
        'headerText' => "null|string",
        'sort'       => "int|null",
        'active'     => "bool",
    ])]
    public function transform(Intro $intro): array
    {
        return [
            'id'         => $intro->getId(),
            'page'       => $intro->getPage(),
            'target'     => $intro->getTarget(),
            'content'    => $intro->getContent(),
            'position'   => $intro->getPosition(),
            'headerText' => $intro->getHeader(),
            'sort'       => $intro->getSort(),
            'active'     => $intro->isActive(),
        ];
    }
}
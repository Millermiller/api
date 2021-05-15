<?php


namespace Scandinaver\Common\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Model\Intro;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class IntroTransformer extends TransformerAbstract
{

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
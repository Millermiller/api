<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Common\Domain\Model\Intro;

/**
 * Class IntroFactory
 *
 * @package Scandinaver\Common\Domain\Service
 */
class IntroFactory
{

    public static function fromDTO(IntroDTO $introDTO): Intro
    {
        $intro = new Intro();

        $intro->setPage($introDTO->getPage());
        $intro->setTarget($introDTO->getTarget());
        $intro->setPosition($introDTO->getPosition());
        $intro->setContent($introDTO->getContent());
        $intro->setTooltipclass($introDTO->getTooltipClass());
        $intro->setSort($introDTO->getSort());

        return $intro;
    }

    public static function toDTO(Intro $intro): IntroDTO
    {
        return IntroDTO::fromArray([
            'id'           => $intro->getId(),
            'page'         => $intro->getPage(),
            'target'       => $intro->getTarget(),
            'content'      => $intro->getContent(),
            'position'     => $intro->getPosition(),
            'tooltipClass' => $intro->getTooltipclass(),
            'sort'         => $intro->getSort(),
        ]);
    }

    public static function update(Intro $intro, IntroDTO $introDTO): Intro
    {
        $intro->setPage($introDTO->getPage());
        $intro->setTarget($introDTO->getTarget());
        $intro->setPosition($introDTO->getPosition());
        $intro->setContent($introDTO->getContent());
        $intro->setTooltipclass($introDTO->getTooltipClass());
        $intro->setSort($introDTO->getSort());

        return $intro;
    }
}
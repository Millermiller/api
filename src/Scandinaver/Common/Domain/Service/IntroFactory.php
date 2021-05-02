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
        $introDTO = new IntroDTO();

        $introDTO->setId($intro->getId());
        $introDTO->setPage($intro->getPage());
        $introDTO->setTarget($intro->getTarget());
        $introDTO->setContent($intro->getContent());
        $introDTO->setPosition($intro->getPosition());
        $introDTO->setTooltipClass($intro->getTooltipclass());
        $introDTO->setSort($intro->getSort());

        return $introDTO;
    }
}
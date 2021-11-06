<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\DTO\IntroDTO;
use Scandinaver\Common\Domain\Entity\Intro;

/**
 * Class IntroFactory
 *
 * @package Scandinaver\Common\Domain\Service
 */
class IntroFactory
{

    public static function fromDTO(IntroDTO $introDTO): Intro
    {
        return self::update(new Intro(), $introDTO);
    }

    public static function toDTO(Intro $intro): IntroDTO
    {
        return IntroDTO::fromArray([
            'id'           => $intro->getId(),
            'page'         => $intro->getPage(),
            'target'       => $intro->getTarget(),
            'content'      => $intro->getContent(),
            'position'     => $intro->getPosition(),
            'header'       => $intro->getHeader(),
            'sort'         => $intro->getSort(),
        ]);
    }

    public static function update(Intro $intro, IntroDTO $introDTO): Intro
    {
        $intro->setPage($introDTO->getPage());
        $intro->setTarget($introDTO->getTarget());
        $intro->setPosition($introDTO->getPosition());
        $intro->setContent($introDTO->getContent());
        $intro->setHeader($introDTO->getHeader());
        $intro->setSort($introDTO->getSort());
        $intro->setActive($introDTO->isActive());

        return $intro;
    }
}
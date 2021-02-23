<?php


namespace Scandinaver\Common\Domain\Services;


use Scandinaver\Common\Domain\Model\Intro;

/**
 * Class IntroFactory
 *
 * @package Scandinaver\Common\Domain\Services
 */
class IntroFactory
{
    public static function build(array $data): Intro
    {
        $intro = new Intro();

        $intro->setPage($data['page']);
        $intro->setTarget($data['target']);
        $intro->setPosition($data['position']);
        $intro->setContent($data['content']);
        $intro->setTooltipclass($data['tooltipClass']);
        $intro->setSort($data['sort']);

        return $intro;
    }
}
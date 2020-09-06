<?php


namespace Scandinaver\Common\Domain\Services;


use Scandinaver\Common\Domain\Model\Intro;

class IntroFactory
{
    public static function build(array $data): Intro
    {
        $intro = new Intro();

        $intro->setPage($data['page']);
        $intro->setElement($data['element']);
        $intro->setPosition($data['position']);
        $intro->setIntro($data['intro']);

        return $intro;
    }
}
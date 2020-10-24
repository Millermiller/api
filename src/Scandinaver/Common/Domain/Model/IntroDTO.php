<?php


namespace Scandinaver\Common\Domain\Model;


use Scandinaver\Shared\DTO;

class IntroDTO extends DTO
{
    private Intro $intro;

    public function __construct(Intro $intro)
    {
        $this->intro = $intro;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->intro->getId(),
            'page' => $this->intro->getPage(),
            'target' => $this->intro->getTarget(),
            'content' => $this->intro->getContent(),
            'position' => $this->intro->getPosition(),
            'tooltipClass' => $this->intro->getTooltipclass(),
            'sort' => $this->intro->getSort(),
        ];
    }
}
<?php


namespace Scandinaver\Learning\Translate\Domain\Service;


use Scandinaver\Learning\Translate\Domain\DTO\TooltipDTO;
use Scandinaver\Learning\Translate\Domain\Entity\Tooltip;

/**
 * Class TooltipFactory
 *
 * @package Scandinaver\Translate\Domain\Service
 */
class TooltipFactory
{

    public static function fromDTO(TooltipDTO $tooltipDTO): Tooltip
    {
        $tooltip = new Tooltip();
        $tooltip->setObject($tooltipDTO->getObject());
        $tooltip->setValue($tooltipDTO->getValue());

        return $tooltip;
    }
}
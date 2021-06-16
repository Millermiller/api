<?php


namespace Scandinaver\Translate\Domain\Service;


use Scandinaver\Translate\Domain\DTO\ExtraDTO;
use Scandinaver\Translate\Domain\Entity\TextExtra;

/**
 * Class ExtraFactory
 *
 * @package Scandinaver\Translate\Domain\Service
 */
class ExtraFactory
{

    public static function fromDTO(ExtraDTO $extraDTO): TextExtra
    {
        $textExtra = new TextExtra();
        $textExtra->setObject($extraDTO->getObject());
        $textExtra->setValue($extraDTO->getValue());

        return $textExtra;
    }
}
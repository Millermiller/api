<?php


namespace Scandinaver\Learning\Asset\Domain\Service;


use Scandinaver\Learning\Asset\Domain\Entity\Example;
use Scandinaver\Learning\Asset\Domain\Entity\ExampleDTO;

/**
 * Class ExampleFactory
 *
 * @package Scandinaver\Learn\Domain\Service
 */
class ExampleFactory
{

    public static function fromDTO(ExampleDTO $exampleDTO): Example
    {
        $example = new Example();
        $id = $exampleDTO->getId();
        if ($id !== NULL) {
            $example->setId($id);
        }
        $example->setText($exampleDTO->getText());
        $example->setValue($exampleDTO->getValue());
        $example->setCard($exampleDTO->getCard());

        return $example;
    }

    public static function toDTO(Example $example): ExampleDTO
    {
        $exampleDTO = new ExampleDTO();

        $exampleDTO->setText($example->getText());
        $exampleDTO->setValue($example->getValue());

        return $exampleDTO;
    }
}
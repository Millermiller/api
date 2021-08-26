<?php


namespace Scandinaver\Translate\Domain\Service;

use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\Translate\Domain\Entity\DictionaryItem;

/**
 * Class TextFactory
 *
 * @package Scandinaver\Translate\Domain\Services
 */
class TextFactory
{

    public static function fromDTO(TextDTO $textDTO): Text
    {
        $text = new Text();

        $text->setTitle($textDTO->getTitle());
        $text->setDescription($textDTO->getDescription());
        $text->setText($textDTO->getText());
        $text->setTranslate($textDTO->getTranslate());

        return $text;
    }

    public static function toDTO(Text $text): TextDTO
    {
        $textDTO = new TextDTO();

        $textDTO->setId($text->getId());
        $textDTO->setTitle($text->getTitle());
        $textDTO->setText($text->getText());
        $textDTO->setLanguage($text->getLanguage());
        $textDTO->setLanguage($text->getLanguage());
        $textDTO->setLevel($text->getLevel());
        $textDTO->setDescription($text->getDescription());
        $textDTO->setImage($text->getImage());

        return $textDTO;
    }
}
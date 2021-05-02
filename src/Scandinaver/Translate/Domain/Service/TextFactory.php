<?php


namespace Scandinaver\Translate\Domain\Service;

use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\Model\Text;

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
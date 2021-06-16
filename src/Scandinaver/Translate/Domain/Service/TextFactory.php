<?php


namespace Scandinaver\Translate\Domain\Service;

use Scandinaver\Translate\Domain\DTO\TextDTO;
use Scandinaver\Translate\Domain\Entity\Text;
use Scandinaver\Translate\Domain\Entity\Word;

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

        $sentences = explode('.', trim($text->getText()));
        array_pop($sentences);
        foreach ($sentences as $num => $sentence) {
            $words           = explode(' ', str_replace(',', '', trim($sentence)));
            $sentences[$num] = $words;
        }

        foreach ($sentences as $num => $sentence) {
            foreach ($sentence as $word) {
                $wordEntity = new Word();
                $wordEntity->setSentenceNum($num);
                $wordEntity->setWord($word);
                $wordEntity->setText($text);
                $text->addWord($wordEntity);
            }
        }

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
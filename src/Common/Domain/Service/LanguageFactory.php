<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\DTO\LanguageDTO;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class LanguageFactory
 *
 * @package Scandinaver\Common\Domain\Service
 */
class LanguageFactory
{

    public static function fromDTO(LanguageDTO $languageDTO): Language
    {
        $language = new Language();

        $language->setLetter($languageDTO->getLetter());
        $language->setTitle($languageDTO->getTitle());

        return $language;
    }

    public static function toDTO(Language $language): LanguageDTO
    {
        $languageDTO = LanguageDTO::fromArray([
            'id'     => $language->getId(),
            'letter' => $language->getLetter(),
            'title'  => $language->getTitle(),
        ]);

        $languageDTO->setFlag(asset('img/' . $language->getFlag()));

        return $languageDTO;
    }
}
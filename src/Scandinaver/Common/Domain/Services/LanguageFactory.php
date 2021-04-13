<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\DTO\LanguageDTO;
use Scandinaver\Common\Domain\Model\Language;

/**
 * Class LanguageFactory
 *
 * @package Scandinaver\Common\Domain\Services
 */
class LanguageFactory
{
    public static function fromDTO(LanguageDTO $languageDTO): Language
    {
        $language = new Language();

        $language->setLabel($languageDTO->getLabel());
        $language->setTitle($languageDTO->getTitle());

        return $language;
    }

    public static function toDTO(Language $language): LanguageDTO
    {
        $languageDTO = new LanguageDTO();

        $languageDTO->setId($language->getId());
        $languageDTO->setTitle($language->getTitle());
        $languageDTO->setLabel($language->getLabel());
        $languageDTO->setLetter($language->getLabel());
        $languageDTO->setFlag(asset('img/'.$language->getFlag()));

        return $languageDTO;
    }
}
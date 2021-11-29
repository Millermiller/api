<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Core\Infrastructure\Service\Container;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;

/**
 * Trait LanguageTrait
 *
 * @package Scandinaver\Common\Domain\Service
 */
trait LanguageTrait
{
    /**
     * @param  string  $name
     *
     * @return Language
     * @throws LanguageNotFoundException
     */
    private function getLanguage(string $name): Language
    {
        $repository = Container::getInstance()->get(LanguageRepositoryInterface::class);

        $language = $repository->findOneBy(
            [
                'letter' => $name,
            ]
        );

        if ($language === NULL) {
            throw new LanguageNotFoundException();
        }

        return $language;
    }

    /**
     * @param  int  $id
     *
     * @return Language
     * @throws LanguageNotFoundException
     */
    private function getLanguageById(int $id): Language
    {
        $repository = Container::getInstance()->get(LanguageRepositoryInterface::class);

        $language = $repository->find($id);

        if ($language === NULL) {
            throw new LanguageNotFoundException();
        }

        return $language;
    }
}
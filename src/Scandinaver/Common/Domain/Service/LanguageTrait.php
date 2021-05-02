<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Exception\LanguageNotFoundException;

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
        /** @var  LanguageRepositoryInterface $repository */
        $repository = Container::getInstance()->get(LanguageRepositoryInterface::class);

        /** @var Language $language */
        $language = $repository->findOneBy(
            [
                'name' => $name,
            ]
        );

        if ($language === NULL) {
            throw new LanguageNotFoundException();
        }

        return $language;
    }
}
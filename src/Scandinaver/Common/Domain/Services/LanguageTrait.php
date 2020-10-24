<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Infrastructure\Container;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;

/**
 * Trait LanguageTrait
 *
 * @package Scandinaver\Common\Domain\Services
 */
trait LanguageTrait
{
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

        if ($language === null) {
            throw new LanguageNotFoundException();
        }

        return $language;
    }
}
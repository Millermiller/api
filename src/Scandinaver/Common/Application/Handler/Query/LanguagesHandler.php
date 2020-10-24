<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\LanguagesHandlerInterface;
use Scandinaver\Common\Domain\Services\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;

/**
 * Class LanguagesHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesHandler implements LanguagesHandlerInterface
{
    private LanguageService $languageService;

    /**
     * LanguagesHandler constructor.
     *
     * @param  LanguageService  $languageService
     */
    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * @param  LanguagesQuery  $command
     *
     * @return array
     */
    public function handle($command): array
    {
        return $this->languageService->getLanguagesList();
    }
}
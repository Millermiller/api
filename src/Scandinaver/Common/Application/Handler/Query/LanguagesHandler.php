<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\Domain\Contract\Query\LanguagesHandlerInterface;
use Scandinaver\Common\Domain\Services\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  LanguagesQuery|Query  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->languageService->all();
    }
}
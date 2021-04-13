<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Contract\Query\LanguagesHandlerInterface;
use Scandinaver\Common\Domain\Services\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Common\UI\Resources\LanguageTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class LanguagesHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesHandler extends AbstractHandler implements LanguagesHandlerInterface
{
    private LanguageService $languageService;

    /**
     * LanguagesHandler constructor.
     *
     * @param  LanguageService  $languageService
     */
    public function __construct(LanguageService $languageService)
    {
        parent::__construct();

        $this->languageService = $languageService;
    }

    /**
     * @param  LanguagesQuery|Query  $query
     */
    public function handle($query): void
    {
        $languages = $this->languageService->all();

        $this->resource = new Collection($languages, new LanguageTransformer());
    }
}
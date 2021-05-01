<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Services\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Common\UI\Resources\LanguageTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class LanguagesQueryHandler
 *
 * @package Scandinaver\API\Application\Handler\Query
 */
class LanguagesQueryHandler extends AbstractHandler
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
     * @param  LanguagesQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $languages = $this->languageService->all();

        $this->resource = new Collection($languages, new LanguageTransformer());
    }
}
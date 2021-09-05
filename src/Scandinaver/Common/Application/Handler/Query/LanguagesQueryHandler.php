<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\LanguageService;
use Scandinaver\Common\UI\Query\LanguagesQuery;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

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
     * @param  LanguagesQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $languages = $this->languageService->all($query->getUser());

        $this->resource = new Collection($languages, new LanguageTransformer());
    }
}
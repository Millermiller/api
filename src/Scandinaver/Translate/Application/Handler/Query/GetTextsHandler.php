<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Contract\Query\GetTextsHandlerInterface;
use Scandinaver\Translate\Domain\Services\TextService;
use Scandinaver\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Translate\UI\Resources\TextTransformer;

/**
 * Class GetTextsHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsHandler extends AbstractHandler implements GetTextsHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetTextsQuery|Query  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle($query): void
    {
        $texts = $this->textService->getAllByLanguage($query->getLanguage());

        $this->resource = new Collection($texts, new TextTransformer());
    }
} 
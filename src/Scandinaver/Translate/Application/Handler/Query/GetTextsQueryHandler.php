<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\Domain\Services\TextService;
use Scandinaver\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Translate\UI\Resources\TextTransformer;

/**
 * Class GetTextsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsQueryHandler extends AbstractHandler
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetTextsQuery|CommandInterface  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(CommandInterface $query): void
    {
        $texts = $this->textService->getAllByLanguage($query->getLanguage());

        $this->resource = new Collection($texts, new TextTransformer());
    }
} 
<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\UI\Resources\TranslateTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetTranslatesByWordHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetTranslatesByWordQueryHandler extends AbstractHandler
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  GetTranslatesByWordQuery|CommandInterface  $query
     */
    public function handle($query): void
    {
        $translates = $this->wordService->getTranslates($query->getWord());

        $this->resource = new Collection($translates, new TranslateTransformer());
    }
} 
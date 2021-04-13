<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learn\Domain\Contract\Query\GetTranslatesByWordHandlerInterface;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\UI\Resources\TranslateTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTranslatesByWordHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetTranslatesByWordHandler extends AbstractHandler extends AbstractHandler implements GetTranslatesByWordHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        parent::__construct();

        $this->wordService = $wordService;
    }

    /**
     * @param  GetTranslatesByWordQuery|Query  $query
     *
     * @return Translate[]
     */
    public function handle($query): array
    {
        $translates = $this->wordService->getTranslates($query->getWord());

        $this->resource = new Collection($translates, new TranslateTransformer());

        return $this->processData();
    }
} 
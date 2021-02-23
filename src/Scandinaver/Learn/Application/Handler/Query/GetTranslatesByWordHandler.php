<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\GetTranslatesByWordHandlerInterface;
use Scandinaver\Learn\Domain\Model\Translate;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\GetTranslatesByWordQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetTranslatesByWordHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetTranslatesByWordHandler implements GetTranslatesByWordHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param  GetTranslatesByWordQuery|Query  $query
     *
     * @return Translate[]
     */
    public function handle($query): array
    {
        return $this->wordService->getTranslates($query->getWord());
    }
} 
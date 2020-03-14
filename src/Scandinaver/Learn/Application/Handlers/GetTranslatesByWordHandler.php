<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\GetTranslatesByWordQuery;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\Domain\Translate;

/**
 * Class GetTranslatesByWordHandler
 * @package Scandinaver\Learn\Application\Handlers
 */
class GetTranslatesByWordHandler implements GetTranslatesByWordHandlerInterface
{
    /**
     * @var WordService
     */
    private $wordService;

    /**
     * GetTranslatesByWordHandler constructor.
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param GetTranslatesByWordQuery
     * @return Translate[]
     */
    public function handle($query): array
    {
        return $this->wordService->getTranslates($query->getWord());
    }
} 
<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\WordsCountQuery;
use Scandinaver\Learn\Domain\Services\WordService;

/**
 * Class WordsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class WordsCountHandler implements WordsCountHandlerInterface
{
    /**
     * @var WordService
     */
    private $wordService;

    /**
     * WordsCountHandler constructor.
     *
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param WordsCountQuery $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->wordService->count($query->getLanguage());
    }
}
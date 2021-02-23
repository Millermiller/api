<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\WordsCountHandlerInterface;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\WordsCountQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class WordsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class WordsCountHandler implements WordsCountHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param  WordsCountQuery|Query  $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->wordService->count();
    }
}
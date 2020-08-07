<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\WordsCountHandlerInterface;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\WordsCountQuery;

/**
 * Class WordsCountHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
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
     * @param  WordService  $wordService
     */
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param  WordsCountQuery  $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->wordService->count();
    }
}
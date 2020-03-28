<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\AudioCountQuery;
use Scandinaver\Learn\Domain\Services\WordService;

/**
 * Class AudioCountHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class AudioCountHandler implements AudioCountHandlerInterface
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
     * @param AudioCountQuery $query
     *
     * @return int
     */
    public function handle($query): int
    {
        return $this->wordService->count($query->getLanguage());
    }
}
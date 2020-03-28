<?php


namespace Scandinaver\Learn\Application\Handlers;

use Doctrine\DBAL\DBALException;
use Scandinaver\Learn\Application\Query\GetUnusedSentencesQuery;
use Scandinaver\Learn\Domain\Services\WordService;

/**
 * Class GetUnusedSentencesHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class GetUnusedSentencesHandler implements GetUnusedSentencesHandlerInterface
{
    /**
     * @var WordService
     */
    private $wordService;

    /**
     * GetUnusedSentencesHandler constructor.
     *
     * @param WordService $wordService
     */
    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param GetUnusedSentencesQuery $query
     *
     * @return array
     * @throws DBALException
     */
    public function handle($query): array
    {
        return $this->wordService->getSentences();
    }
} 
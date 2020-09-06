<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Doctrine\DBAL\DBALException;
use Scandinaver\Learn\Domain\Contract\Query\GetUnusedSentencesHandlerInterface;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\GetUnusedSentencesQuery;

/**
 * Class GetUnusedSentencesHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class GetUnusedSentencesHandler implements GetUnusedSentencesHandlerInterface
{
    private WordService $wordService;

    public function __construct(WordService $wordService)
    {
        $this->wordService = $wordService;
    }

    /**
     * @param  GetUnusedSentencesQuery  $query
     *
     * @return array
     */
    public function handle($query): array
    {
        return $this->wordService->getSentences($query->getLanguage());
    }
} 
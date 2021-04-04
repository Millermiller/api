<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\GetUnusedSentencesHandlerInterface;
use Scandinaver\Learn\Domain\Exceptions\LanguageNotFoundException;
use Scandinaver\Learn\Domain\Services\WordService;
use Scandinaver\Learn\UI\Query\GetUnusedSentencesQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  GetUnusedSentencesQuery|Query  $query
     *
     * @return array
     * @throws LanguageNotFoundException
     */
    public function handle($query): array
    {
        return $this->wordService->getSentences($query->getLanguage());
    }
} 
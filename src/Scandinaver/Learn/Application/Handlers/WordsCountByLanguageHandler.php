<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\WordsCountByLanguageQuery;

/**
 * Class WordsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class WordsCountByLanguageHandler implements WordsCountByLanguageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param WordsCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
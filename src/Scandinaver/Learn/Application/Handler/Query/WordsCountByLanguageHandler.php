<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\WordsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\WordsCountByLanguageQuery;

/**
 * Class WordsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class WordsCountByLanguageHandler implements WordsCountByLanguageHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  WordsCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
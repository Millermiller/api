<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\WordsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\WordsCountByLanguageQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  WordsCountByLanguageQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
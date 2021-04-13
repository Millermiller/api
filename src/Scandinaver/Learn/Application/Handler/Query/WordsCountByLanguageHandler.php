<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\WordsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\WordsCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class WordsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class WordsCountByLanguageHandler extends AbstractHandler implements WordsCountByLanguageHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  WordsCountByLanguageQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 
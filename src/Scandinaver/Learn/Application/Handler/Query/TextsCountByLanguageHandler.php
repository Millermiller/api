<?php


namespace Scandinaver\Learn\Application\Handler\Query;


use Scandinaver\Learn\Domain\Contract\Query\TextsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\TextsCountByLanguageQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class TextsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountByLanguageHandler implements TextsCountByLanguageHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  TextsCountByLanguageQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
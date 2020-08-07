<?php


namespace Scandinaver\Learn\Application\Handler\Query;


use Scandinaver\Learn\Domain\Contract\Query\TextsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\TextsCountByLanguageQuery;

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
     * @param  TextsCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
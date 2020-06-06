<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\TextsCountByLanguageQuery;

/**
 * Class TextsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class TextsCountByLanguageHandler implements TextsCountByLanguageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param TextsCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
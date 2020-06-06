<?php


namespace Scandinaver\Learn\Application\Handlers;

use Scandinaver\Learn\Application\Query\AudioCountByLanguageQuery;

/**
 * Class AudioCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handlers
 */
class AudioCountByLanguageHandler implements AudioCountByLanguageHandlerInterface
{
    public function __construct()
    {

    }

    /**
     * @param AudioCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
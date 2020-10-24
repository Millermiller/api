<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AudioCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\AudioCountByLanguageQuery;

/**
 * Class AudioCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AudioCountByLanguageHandler implements AudioCountByLanguageHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  AudioCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
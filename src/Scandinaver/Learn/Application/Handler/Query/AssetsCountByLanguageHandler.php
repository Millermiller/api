<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AssetsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsCountByLanguageQuery;

/**
 * Class AssetsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountByLanguageHandler implements AssetsCountByLanguageHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  AssetsCountByLanguageQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
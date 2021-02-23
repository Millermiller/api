<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AssetsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsCountByLanguageQuery;
use Scandinaver\Shared\Contract\Query;

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
     * @param  AssetsCountByLanguageQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
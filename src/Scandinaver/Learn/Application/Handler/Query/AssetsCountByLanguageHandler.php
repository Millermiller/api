<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\Domain\Contract\Query\AssetsCountByLanguageHandlerInterface;
use Scandinaver\Learn\UI\Query\AssetsCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsCountByLanguageHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountByLanguageHandler extends AbstractHandler implements AssetsCountByLanguageHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  AssetsCountByLanguageQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 
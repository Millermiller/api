<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use Scandinaver\Learn\UI\Query\AssetsCountByLanguageQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AssetsCountByLanguageQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class AssetsCountByLanguageQueryHandler extends AbstractHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  AssetsCountByLanguageQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Contract\Query\GetSynonymsHandlerInterface;
use Scandinaver\Translate\UI\Query\GetSynonymsQuery;

/**
 * Class GetSynonymsHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetSynonymsHandler implements GetSynonymsHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @param  GetSynonymsQuery|Query  $query
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
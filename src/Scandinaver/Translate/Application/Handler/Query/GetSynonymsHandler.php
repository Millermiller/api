<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Translate\UI\Query\GetSynonymsQuery;
use Scandinaver\Translate\Domain\Contract\Query\GetSynonymsHandlerInterface;

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
     * @param  GetSynonymsQuery  $query
     *
     */
    public function handle($query)
    {
        // TODO: Implement handle() method.
    }
} 
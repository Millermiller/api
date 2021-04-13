<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Contract\Query\GetSynonymsHandlerInterface;
use Scandinaver\Translate\UI\Query\GetSynonymsQuery;

/**
 * Class GetSynonymsHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetSynonymsHandler extends AbstractHandler implements GetSynonymsHandlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  GetSynonymsQuery|Query  $query
     */
    public function handle($query): void
    {
        // TODO: Implement handle() method.
    }
} 
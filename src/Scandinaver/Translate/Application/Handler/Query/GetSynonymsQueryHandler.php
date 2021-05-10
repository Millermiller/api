<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\UI\Query\GetSynonymsQuery;

/**
 * Class GetSynonymsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetSynonymsQueryHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param  GetSynonymsQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
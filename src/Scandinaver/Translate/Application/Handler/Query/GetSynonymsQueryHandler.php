<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
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
     * @param  GetSynonymsQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // TODO: Implement handle() method.
    }
} 
<?php


namespace Scandinaver\Common\Application\Handler\Query;

use Scandinaver\Common\UI\Query\MetasQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class MetasQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class MetasQueryHandler extends AbstractHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|MetasQuery $query): void
    {
        // TODO: Implement handle() method.
    }
} 
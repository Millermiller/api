<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadCardQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class ReadCardQueryHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadCardQueryHandler extends AbstractHandler
{

    public function __construct(private ReaderInterface $reader)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|ReadCardQuery $query): void
    {
        // return $this->reader->read();
    }
} 
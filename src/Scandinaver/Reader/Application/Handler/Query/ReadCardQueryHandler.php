<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadCardQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class ReadCardQueryHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadCardQueryHandler extends AbstractHandler
{
    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader)
    {
        parent::__construct();

        $this->reader = $reader;
    }

    /**
     * @param  ReadCardQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        // return $this->reader->read();
    }
} 
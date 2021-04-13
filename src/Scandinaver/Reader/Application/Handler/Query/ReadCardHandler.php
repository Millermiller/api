<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadCardQuery;
use Scandinaver\Reader\Domain\Contract\Query\ReadCardHandlerInterface;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;

/**
 * Class ReadCardHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadCardHandler extends AbstractHandler implements ReadCardHandlerInterface
{
    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader)
    {
        parent::__construct();

        $this->reader = $reader;
    }

    /**
     * @param  ReadCardQuery|Query  $query
     */
    public function handle($query): void
    {
        // return $this->reader->read();
    }
} 
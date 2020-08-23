<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadCardQuery;
use Scandinaver\Reader\Domain\Contract\Query\ReadCardHandlerInterface;

/**
 * Class ReadCardHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadCardHandler implements ReadCardHandlerInterface
{
    private ReaderInterface $reader;

    /**
     * ReadCardHandler constructor.
     *
     * @param  ReaderInterface  $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param $query ReadCardQuery
     *
     * @inheritDoc
     */
    public function handle($query)
    {
        return $this->reader->read();
    }
} 
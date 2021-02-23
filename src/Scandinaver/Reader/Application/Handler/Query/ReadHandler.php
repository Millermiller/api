<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use Scandinaver\Reader\Domain\Contract\Query\ReadHandlerInterface;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Scandinaver\Shared\Contract\Query;

/**
 * Class ReadHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadHandler implements ReadHandlerInterface
{
    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param  ReadQuery|Query  $query
     *
     * @return mixed
     */
    public function handle($query)
    {
        return $this->reader->read($query->getUser(), $query->getLanguage(), $query->getText());
    }
} 
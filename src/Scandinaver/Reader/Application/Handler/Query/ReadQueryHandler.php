<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class ReadQueryHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadQueryHandler extends AbstractHandler
{
    private ReaderInterface $reader;

    public function __construct(ReaderInterface $reader)
    {
        parent::__construct();

        $this->reader = $reader;
    }

    /**
     * @param  ReadQuery|CommandInterface  $query
     */
    public function handle(CommandInterface $query): void
    {
        $path = $this->reader->read($query->getUser(), $query->getLanguage(), $query->getText());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 
<?php


namespace Scandinaver\Reader\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Reader\Domain\Contract\Service\ReaderInterface;
use Scandinaver\Reader\UI\Query\ReadQuery;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class ReadQueryHandler
 *
 * @package Scandinaver\Reader\Application\Handler\Query
 */
class ReadQueryHandler extends AbstractHandler
{

    public function __construct(private ReaderInterface $reader)
    {
        parent::__construct();
    }

    /**
     * @param  ReadQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $path = $this->reader->read($query->getUser(), $query->getLanguage(), $query->getText());

        $this->resource = new Item($path, fn($data) => ['path' => $data]);
    }
} 
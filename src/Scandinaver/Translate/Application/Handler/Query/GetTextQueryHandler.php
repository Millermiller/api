<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Services\TextService;
use Scandinaver\Translate\UI\Query\GetTextQuery;
use Scandinaver\Translate\UI\Resources\TextTransformer;

/**
 * Class GetTextQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class GetTextQueryHandler extends AbstractHandler
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetTextQuery|CommandInterface  $query
     *
     * @throws TextNotFoundException|Exception
     */
    public function handle(CommandInterface $query): void
    {
        $text = $this->textService->prepareText($query->getText());

        $this->resource = new Item($text, new TextTransformer());
    }
} 
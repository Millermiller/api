<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\Query;
use Scandinaver\Translate\Domain\Contract\Query\GetTextHandlerInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Services\TextService;
use Scandinaver\Translate\UI\Query\GetTextQuery;
use Scandinaver\Translate\UI\Resources\TextTransformer;

/**
 * Class GetTextHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class GetTextHandler extends AbstractHandler implements GetTextHandlerInterface
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetTextQuery|Query  $query
     *
     * @throws TextNotFoundException|Exception
     */
    public function handle($query): void
    {
        $text = $this->textService->prepareText($query->getText());

        $this->resource = new Item($text, new TextTransformer());
    }
} 
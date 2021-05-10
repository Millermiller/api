<?php


namespace Scandinaver\Translate\Application\Handler\Query;

use Doctrine\DBAL\Driver\Exception;
use League\Fractal\Resource\Item;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Service\TextService;
use Scandinaver\Translate\UI\Query\GetTextQuery;
use Scandinaver\Translate\UI\Resource\TextTransformer;

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
     * @param  GetTextQuery|BaseCommandInterface  $query
     *
     * @throws TextNotFoundException|Exception
     */
    public function handle(BaseCommandInterface $query): void
    {
        $text = $this->textService->prepareText($query->getText());

        $this->resource = new Item($text, new TextTransformer());
    }
} 
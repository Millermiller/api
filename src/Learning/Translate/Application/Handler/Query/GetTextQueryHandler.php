<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetTextQuery;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetTextQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler
 */
class GetTextQueryHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetTextQuery  $query
     *
     * @throws TextNotFoundException
     */
    public function handle(BaseCommandInterface|GetTextQuery $query): void
    {
        $text = $this->textService->prepareText($query->getText());

        $this->resource = new Item($text, new TextTransformer());
    }
} 
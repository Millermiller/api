<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;

/**
 * Class GetTextsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsQueryHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetTextsQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $texts = $this->textService->getAllByLanguage($query->getLanguage());

        $this->resource = new Collection($texts, new TextTransformer());
    }
} 
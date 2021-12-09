<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Asset\Domain\Exception\LanguageNotFoundException;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetTextsQuery;
use Scandinaver\Learning\Translate\UI\Resource\TextTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetTextsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetTextsQueryHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|GetTextsQuery  $query
     *
     * @throws LanguageNotFoundException
     */
    public function handle(BaseCommandInterface|GetTextsQuery $query): void
    {
        $texts = $this->textService->getAllByLanguage($query->getLanguage());

        $this->resource = new Collection($texts, new TextTransformer());
    }
} 
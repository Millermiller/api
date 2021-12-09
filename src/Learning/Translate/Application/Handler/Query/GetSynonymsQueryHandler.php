<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetSynonymsQuery;
use Scandinaver\Learning\Translate\UI\Resource\SynonymTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class GetSynonymsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetSynonymsQueryHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    public function handle(BaseCommandInterface|GetSynonymsQuery $query): void
    {
        $synonyms = $this->textService->getSynonymsByWordId($query->getId());

        $this->resource = new Collection($synonyms, new SynonymTransformer());
    }
} 
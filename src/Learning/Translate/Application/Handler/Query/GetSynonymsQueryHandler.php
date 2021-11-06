<?php


namespace Scandinaver\Learning\Translate\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Learning\Translate\UI\Query\GetSynonymsQuery;
use Scandinaver\Learning\Translate\UI\Resource\SynonymTransformer;

/**
 * Class GetSynonymsQueryHandler
 *
 * @package Scandinaver\Translate\Application\Handler\Query
 */
class GetSynonymsQueryHandler extends AbstractHandler
{

    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  GetSynonymsQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $synonyms = $this->textService->getSynonymsByWordId($query->getId());

        $this->resource = new Collection($synonyms, new SynonymTransformer());
    }
} 
<?php


namespace Scandinaver\Learn\Application\Handler\Query;

use League\Fractal\Resource\Primitive;
use Scandinaver\Learn\UI\Query\AssetsCountQuery;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Translate\Domain\Service\TextService;

/**
 * Class TextsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountQueryHandler extends AbstractHandler
{
    private TextService $textService;

    public function __construct(TextService $textService)
    {
        parent::__construct();

        $this->textService = $textService;
    }

    /**
     * @param  AssetsCountQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->textService->count();

        $this->resource = new Primitive($count);
    }
}
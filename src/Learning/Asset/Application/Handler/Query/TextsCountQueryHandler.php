<?php


namespace Scandinaver\Learning\Asset\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Learning\Asset\UI\Query\AssetsCountQuery;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;


/**
 * Class TextsCountQueryHandler
 *
 * @package Scandinaver\Learn\Application\Handler\Query
 */
class TextsCountQueryHandler extends AbstractHandler
{

    public function __construct(private TextService $textService)
    {
        parent::__construct();
    }

    /**
     * @param  AssetsCountQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $count = $this->textService->count();

        $this->resource = new Item($count, fn($data) => ['count' => $count]);
    }
}
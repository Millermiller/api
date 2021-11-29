<?php


namespace Scandinaver\Common\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Common\Domain\Service\IntroService;
use Scandinaver\Common\UI\Query\IntrosQuery;
use Scandinaver\Common\UI\Resource\IntroTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class IntrosQueryHandler
 *
 * @package Scandinaver\Common\Application\Handler\Query
 */
class IntrosQueryHandler extends AbstractHandler
{

    public function __construct(private IntroService $service)
    {
        parent::__construct();
    }

    /**
     * @param  IntrosQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $intros = $this->service->all();

        $this->resource = new Collection($intros, new IntroTransformer());
    }
}
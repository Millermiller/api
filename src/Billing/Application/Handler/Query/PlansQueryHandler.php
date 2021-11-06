<?php


namespace Scandinaver\Billing\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Billing\Domain\Service\PlanService;
use Scandinaver\Billing\UI\Resource\PlanTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;
use Scandinaver\Billing\UI\Query\PlansQuery;

/**
 * Class PlansQueryHandler
 *
 * @package Scandinaver\Billing\Application\Handler\Query
 */
class PlansQueryHandler extends AbstractHandler
{

    private PlanService $planService;

    public function __construct(PlanService $planService)
    {
        parent::__construct();
        $this->planService = $planService;
    }

    /**
     * @param  PlansQuery|BaseCommandInterface  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $plans = $this->planService->all();

        $this->resource = new Collection($plans, new PlanTransformer());
    }
} 
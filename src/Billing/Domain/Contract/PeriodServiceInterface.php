<?php


namespace Scandinaver\Billing\Domain\Contract;


use DateInterval;
use DatePeriod;

/**
 * Class PeriodServiceInterface
 *
 * @package Scandinaver\Billing\Domain\Contract
 */
interface PeriodServiceInterface
{

    public function getDuration(): DateInterval;
}
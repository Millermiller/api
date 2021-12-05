<?php


namespace Scandinaver\Settings\Domain\Contract\Repository;

use Scandinaver\Core\Domain\Contract\Repository\FilterableRepositoryInterface;
use Scandinaver\Core\Domain\Contract\Repository\BaseRepositoryInterface;

/**
 * Interface SettingRepositoryInterface
 *
 * @extends BaseRepositoryInterface<Setting>
 * @package Scandinaver\Settings\Domain\Contract\Repository
 */
interface SettingRepositoryInterface extends BaseRepositoryInterface, FilterableRepositoryInterface
{

}
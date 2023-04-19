<?php


namespace Scandinaver\Settings\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Query\SettingQuery;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class SettingQueryHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Query
 */
class SettingQueryHandler extends AbstractHandler
{

    public function __construct(private readonly SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  BaseCommandInterface|SettingQuery  $query
     *
     * @throws SettingNotFoundException
     */
    public function handle(BaseCommandInterface|SettingQuery $query): void
    {
        $setting = $this->settingsService->one($query->getId());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 
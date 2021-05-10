<?php


namespace Scandinaver\Settings\Application\Handler\Query;

use League\Fractal\Resource\Item;
use Scandinaver\Settings\Domain\Exception\SettingNotFoundException;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Query\SettingQuery;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class SettingQueryHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Query
 */
class SettingQueryHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();

        $this->settingsService = $settingsService;
    }

    /**
     * @param  SettingQuery|BaseCommandInterface  $query
     *
     * @throws SettingNotFoundException
     */
    public function handle(BaseCommandInterface $query): void
    {
        $setting = $this->settingsService->one($query->getId());

        $this->resource = new Item($setting, new SettingTransformer());
    }
} 
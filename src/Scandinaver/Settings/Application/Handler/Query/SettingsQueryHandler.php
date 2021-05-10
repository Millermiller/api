<?php


namespace Scandinaver\Settings\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Query\SettingsQuery;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Shared\AbstractHandler;
use Scandinaver\Shared\Contract\BaseCommandInterface;

/**
 * Class SettingsQueryHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Query
 */
class SettingsQueryHandler extends AbstractHandler
{

    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        parent::__construct();
        $this->settingsService = $settingsService;
    }

    /**
     * @param SettingsQuery|BaseCommandInterface $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $settings = $this->settingsService->all();

        $this->resource = new Collection($settings, new SettingTransformer());
    }
} 
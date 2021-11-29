<?php


namespace Scandinaver\Settings\Application\Handler\Query;

use League\Fractal\Resource\Collection;
use Scandinaver\Settings\Domain\Service\SettingsService;
use Scandinaver\Settings\UI\Query\SettingsQuery;
use Scandinaver\Settings\UI\Resource\SettingTransformer;
use Scandinaver\Core\Domain\AbstractHandler;
use Scandinaver\Core\Domain\Contract\BaseCommandInterface;

/**
 * Class SettingsQueryHandler
 *
 * @package Scandinaver\Settings\Application\Handler\Query
 */
class SettingsQueryHandler extends AbstractHandler
{

    public function __construct(private SettingsService $settingsService)
    {
        parent::__construct();
    }

    /**
     * @param  SettingsQuery  $query
     */
    public function handle(BaseCommandInterface $query): void
    {
        $settings = $this->settingsService->all();

        $this->resource = new Collection($settings, new SettingTransformer());
    }
} 
<?php


namespace App\Providers;

use App\Policies\{AssetPolicy, CardPolicy, TextPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Scandinaver\Learn\Domain\{Asset, Card};
use Scandinaver\Translate\Domain\Text;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Card::class  => CardPolicy::class,
        Asset::class => AssetPolicy::class,
        Text::class  => TextPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}

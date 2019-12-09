<?php

namespace App\Providers;

use App\Entities\{Asset, Card, Text};
use App\Policies\{AssetPolicy, CardPolicy, textPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Card::class => CardPolicy::class,
        Asset::class => AssetPolicy::class,
        Text::class => TextPolicy::class,
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

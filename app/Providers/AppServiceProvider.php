<?php

namespace App\Providers;

use App\Entities\{Plan, User, Language, Asset, Text};
use App\Repositories\Plan\{PlanRepository, PlanRepositoryInterface};
use App\Repositories\User\{UserRepository, UserRepositoryInterface};
use App\Repositories\Asset\{AssetRepository, AssetRepositoryInterface};
use App\Repositories\Language\{LanguageRepository, LanguageRepositoryInterface};
use App\Repositories\Text\{TextRepository, TextRepositoryInterface};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       // dd(Auth::user());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(User::class)
            );
        });

        $this->app->bind(PlanRepositoryInterface::class, function () {
            return new PlanRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Plan::class)
            );
        });

        $this->app->bind(LanguageRepositoryInterface::class, function () {
            return new LanguageRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Language::class)
            );
        });

        $this->app->bind(AssetRepositoryInterface::class, function () {
            return new AssetRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Asset::class)
            );
        });

        $this->app->bind(TextRepositoryInterface::class, function () {
            return new TextRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Text::class)
            );
        });
    }
}

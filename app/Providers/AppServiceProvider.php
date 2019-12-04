<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use app\Services\UserService;

use Auth;
use Illuminate\Support\ServiceProvider;
use App\Entities\User;

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
    }
}

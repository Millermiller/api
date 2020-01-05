<?php

namespace App\Providers;

use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Card\{CardRepository, CardRepositoryInterface};
use App\Repositories\Intro\{IntroRepository, IntroRepositoryInterface};
use App\Repositories\Translate\{TranslateRepository, TranslateRepositoryInterface};
use App\Repositories\Word\{WordRepository, WordRepositoryInterface};
use App\Repositories\Result\{ResultRepository, ResultRepositoryInterface};
use App\Repositories\Plan\{PlanRepository, PlanRepositoryInterface};
use App\Repositories\User\{UserRepository, UserRepositoryInterface};
use App\Repositories\Asset\{AssetRepository, AssetRepositoryInterface};
use App\Repositories\Language\{LanguageRepository, LanguageRepositoryInterface};
use App\Repositories\Post\{PostRepository, PostRepositoryInterface};
use Laravel\Passport\Passport;
use App\Entities\{Card, Message, Plan, Result, Translate, User, Language, Asset, Intro, Word, Post};

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
        Passport::ignoreMigrations();

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

        $this->app->bind(IntroRepositoryInterface::class, function () {
            return new IntroRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Intro::class)
            );
        });

        $this->app->bind(MessageRepositoryInterface::class, function () {
            return new MessageRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Message::class)
            );
        });

        $this->app->bind(PostRepositoryInterface::class, function () {
            return new PostRepository(
                $this->app['em'],
                $this->app['em']->getClassMetadata(Post::class)
            );
        });
    }
}

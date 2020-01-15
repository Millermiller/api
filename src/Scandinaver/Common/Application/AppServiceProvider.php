<?php


namespace Scandinaver\Common\Application;

use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Blog\Domain\Post;
use Scandinaver\Blog\Domain\Contracts\PostRepositoryInterface;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;
use Scandinaver\Common\Domain\Contracts\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Contracts\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contracts\MessageRepositoryInterface;
use Scandinaver\Common\Domain\{Intro, Language, Message};
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\IntroRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LanguageRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\MessageRepository;

/**
 * Class AppServiceProvider
 * @package Scandinaver\Common\Application
 */
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

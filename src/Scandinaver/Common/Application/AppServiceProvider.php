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

        $this->app->bind(
            'MessagesHandlerInterface',
            'Scandinaver\Common\Application\Handlers\MessagesHandler'
        );

        $this->app->bind(
            'IntrosHandlerInterface',
            'Scandinaver\Common\Application\Handlers\IntrosHandler'
        );

        $this->app->bind(
            'IntroHandlerInterface',
            'Scandinaver\Common\Application\Handlers\IntroHandler'
        );

        $this->app->bind(
            'CreateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handlers\CreateMessageHandler'
        );

        $this->app->bind(
            'DeleteMessageHandlerInterface',
            'Scandinaver\Common\Application\Handlers\DeleteMessageHandler'
        );

        $this->app->bind(
            'MessageHandlerInterface',
            'Scandinaver\Common\Application\Handlers\MessageHandler'
        );

        $this->app->bind(
            'UpdateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handlers\UpdateMessageHandler'
        );
    }
}

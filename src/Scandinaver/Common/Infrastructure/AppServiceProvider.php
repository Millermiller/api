<?php


namespace Scandinaver\Common\Infrastructure;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;
use Scandinaver\Common\Domain\{Contract\HashInterface,
    Contract\RedisInterface,
    Model\Intro,
    Model\Language,
    Model\Message
};
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\IntroRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LanguageRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\MessageRepository;

/**
 * Class AppServiceProvider
 *
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

        $this->app->bind(
            LanguageRepositoryInterface::class,
            function () {
                return new LanguageRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Language::class)
                );
            }
        );

        $this->app->bind(
            IntroRepositoryInterface::class,
            function () {
                return new IntroRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Intro::class)
                );
            }
        );

        $this->app->bind(
            MessageRepositoryInterface::class,
            function () {
                return new MessageRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Message::class)
                );
            }
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            function () {
                return new PostRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Post::class)
                );
            }
        );

        $this->app->bind(
            'MessagesHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MessagesHandler'
        );

        $this->app->bind(
            'IntrosHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\IntrosHandler'
        );

        $this->app->bind(
            'IntroHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\IntroHandler'
        );

        $this->app->bind(
            'CreateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\CreateMessageHandler'
        );

        $this->app->bind(
            'DeleteMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\DeleteMessageHandler'
        );

        $this->app->bind(
            'MessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MessageHandler'
        );

        $this->app->bind(
            'UpdateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\UpdateMessageHandler'
        );

        $this->app->bind(
            'LanguagesHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\LanguagesHandler'
        );

        $this->app->bind(HashInterface::class, LaravelHash::class);

        $this->app->bind(RedisInterface::class, LaravelRedis::class);
    }

}

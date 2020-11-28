<?php


namespace Scandinaver\Common\Infrastructure;


use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;
use Scandinaver\Common\Domain\Contract\HashInterface;
use Scandinaver\Common\Domain\Contract\RedisInterface;
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\Common\Domain\Model\Message;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\IntroRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LanguageRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LogRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\MessageRepository;

class DoctrineServiceProvider extends ServiceProvider
{
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
            LogRepositoryInterface::class,
            function () {
                return new LogRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Log::class)
                );
            }
        );
    }
}
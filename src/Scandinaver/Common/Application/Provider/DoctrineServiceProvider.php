<?php


namespace Scandinaver\Common\Application\Provider;

use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Scandinaver\Blog\Domain\Contract\Repository\PostRepositoryInterface;
use Scandinaver\Blog\Domain\Model\Post;
use Scandinaver\Blog\Infrastructure\Persistence\Doctrine\PostRepository;
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\FeedbackRepositoryInterface;
use Scandinaver\Common\Domain\Model\Intro;
use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Common\Domain\Model\Log;
use Scandinaver\Common\Domain\Model\Feedback;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\IntroRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LanguageRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\LogRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\FeedbackRepository;

/**
 * Class DoctrineServiceProvider
 *
 * @package Scandinaver\Common\Application\Provider
 */
class DoctrineServiceProvider extends ServiceProvider
{

    public function register()
    {
        Passport::ignoreMigrations();

        /** @var EntityManager $em */
        $em = $this->app['em'];

        $this->app->bind(
            LanguageRepositoryInterface::class,
            fn() => new LanguageRepository($em, $em->getClassMetadata(Language::class))
        );

        $this->app->bind(
            IntroRepositoryInterface::class,
            fn() => new IntroRepository($em, $em->getClassMetadata(Intro::class))
        );

        $this->app->bind(
            FeedbackRepositoryInterface::class,
            fn() => new FeedbackRepository($em, $em->getClassMetadata(Feedback::class))
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            fn() => new PostRepository($em, $em->getClassMetadata(Post::class))
        );

        $this->app->bind(
            LogRepositoryInterface::class,
            fn() => new LogRepository($em, $em->getClassMetadata(Log::class))
        );
    }
}
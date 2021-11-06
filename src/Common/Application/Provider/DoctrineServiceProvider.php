<?php


namespace Scandinaver\Common\Application\Provider;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Scandinaver\Common\Domain\Contract\Repository\IntroRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LanguageRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\LogRepositoryInterface;
use Scandinaver\Common\Domain\Contract\Repository\FeedbackRepositoryInterface;
use Scandinaver\Common\Domain\Entity\Intro;
use Scandinaver\Common\Domain\Entity\Language;
use Scandinaver\Common\Domain\Entity\Log;
use Scandinaver\Common\Domain\Entity\Feedback;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\IntroRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\LanguageRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\LogRepository;
use Scandinaver\Common\Infrastructure\Persistence\Doctrine\Repository\FeedbackRepository;
use Scandinaver\Shared\Contract\BaseRepositoryInterface;

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
            FeedbackRepositoryInterface::class,
            function () {
                return new FeedbackRepository(
                    $this->app['em'],
                    $this->app['em']->getClassMetadata(Feedback::class)
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
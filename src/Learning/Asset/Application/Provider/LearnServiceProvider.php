<?php


namespace Scandinaver\Learning\Asset\Application\Provider;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Learning\Asset\Domain\Contract\AudioParserInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learning\Asset\Domain\Contract\Service\TranslaterInterface;

/**
 * Class LearnServiceProvider
 *
 * @package Scandinaver\Learn\Application\Provider
 *
 */
class LearnServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TranslaterInterface::class,
            'Scandinaver\Learning\Asset\Infrastructure\Service\YandexTranslater'
        );

        $this->app->bind(
            AudioParserInterface::class,
            'Scandinaver\Learning\Asset\Infrastructure\Service\ForvoParser'
        );

        $this->app->bind(
            SearchInterface::class,
            'Scandinaver\Learning\Asset\Infrastructure\Service\ElasticSearchService'
        );

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                                ->setHosts(['scandinaver_elastic:9200'])
                                ->build();
        });
    }
}
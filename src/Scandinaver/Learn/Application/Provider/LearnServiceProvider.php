<?php


namespace Scandinaver\Learn\Application\Provider;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\AudioParserInterface;
use Scandinaver\Learn\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;

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
            'Scandinaver\Learn\Infrastructure\Service\YandexTranslater'
        );

        $this->app->bind(
            AudioParserInterface::class,
            'Scandinaver\Learn\Infrastructure\Service\ForvoParser'
        );

        $this->app->bind(
            SearchInterface::class,
            'Scandinaver\Learn\Infrastructure\Service\ElasticSearchService'
        );

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                                ->setHosts(['scandinaver_elastic:9200'])
                                ->build();
        });
    }
}
<?php


namespace Scandinaver\Learn\Application\Providers;


use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use Scandinaver\Learn\Domain\Contract\AudioParserInterface;
use Scandinaver\Learn\Domain\Contract\Service\SearchInterface;
use Scandinaver\Learn\Domain\Contract\Service\TranslaterInterface;

/**
 * Class CustomServiceProvider
 *
 * @package Scandinaver\Learn\Application\Providers
 */
class CustomServiceProvider extends ServiceProvider
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
            $d = config('elastic.hosts');
            $g = $d;
            return ClientBuilder::create()
                                ->setHosts(['scandinaver_elastic:9200'])
                                ->build();
        });
    }
}
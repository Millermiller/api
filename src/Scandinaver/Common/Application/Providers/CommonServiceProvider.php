<?php


namespace Scandinaver\Common\Application\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class CommonServiceProvider
 *
 * @package Scandinaver\Common\Application\Providers
 */
class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** COMMAND **/
        $this->app->bind(
            'CreateIntroHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\CreateIntroHandler'
        );

        $this->app->bind(
            'CreateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\CreateMessageHandler'
        );

        $this->app->bind(
            'CreateMetaHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\CreateMetaHandler'
        );

        $this->app->bind(
            'DeleteIntroHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\DeleteIntroHandler'
        );

        $this->app->bind(
            'DeleteLogHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\DeleteLogHandler'
        );

        $this->app->bind(
            'DeleteMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\DeleteMessageHandler'
        );

        $this->app->bind(
            'DeleteMetaHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\DeleteMetaHandler'
        );

        $this->app->bind(
            'UpdateIntroHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\UpdateIntroHandler'
        );

        $this->app->bind(
            'UpdateMessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\UpdateMessageHandler'
        );

        $this->app->bind(
            'UpdateMetaHandlerInterface',
            'Scandinaver\Common\Application\Handler\Command\UpdateMetaHandler'
        );

        /** QUERY **/
        $this->app->bind(
            'IntroHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\IntroHandler'
        );

        $this->app->bind(
            'IntrosHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\IntrosHandler'
        );

        $this->app->bind(
            'LanguagesHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\LanguagesHandler'
        );

        $this->app->bind(
            'LogHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\LogHandler'
        );

        $this->app->bind(
            'LogsHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\LogsHandler'
        );

        $this->app->bind(
            'MessageHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MessageHandler'
        );

        $this->app->bind(
            'MessagesHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MessagesHandler'
        );

        $this->app->bind(
            'MetaHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MetaHandler'
        );

        $this->app->bind(
            'MetasHandlerInterface',
            'Scandinaver\Common\Application\Handler\Query\MetasHandler'
        );
    }
}
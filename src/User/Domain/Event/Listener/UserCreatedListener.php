<?php


namespace Scandinaver\User\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\User\Domain\Event\UserCreated;

/**
 * Class UserCreatedListener
 *
 * @package Scandinaver\User\Domain\Event\Listener
 */
class UserCreatedListener
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {

        $this->logger = $logger;
    }

    public function handle(UserCreated $event): void
    {
        $user = $event->getUser();

        $this->logger->info('User {login} created',
            [
                'login' => $user->getLogin(),
            ]);
    }
}
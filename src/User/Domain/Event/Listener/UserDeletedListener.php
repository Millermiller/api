<?php


namespace Scandinaver\User\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learning\Asset\Domain\Service\AssetService;
use Scandinaver\Learning\Translate\Domain\Service\TextService;
use Scandinaver\User\Domain\Event\UserDeleted;

/**
 * Class UserDeletedListener
 *
 * @package Scandinaver\User\Domain\Event\Listener
 */
class UserDeletedListener
{

    private LoggerInterface $logger;

    private AssetService $assetService;

    private TextService $textService;

    public function __construct(LoggerInterface $logger, AssetService $assetService, TextService $textService)
    {
        $this->logger       = $logger;
        $this->assetService = $assetService;
        $this->textService  = $textService;
    }

    public function handle(UserDeleted $event): void
    {
        $user = $event->getUser();

        $this->assetService->removeByUser($user);
        $this->textService->removePassingsByUser($user);

        $this->logger->info('User {login} deleted',
            [
                'login' => $user->getLogin(),
            ]);
    }
}
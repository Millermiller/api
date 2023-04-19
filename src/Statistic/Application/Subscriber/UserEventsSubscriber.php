<?php

namespace Scandinaver\Statistic\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Scandinaver\Statistic\Domain\DTO\StatisticItemDTO;
use Scandinaver\Statistic\Domain\Enum\StatisticType;
use Scandinaver\Statistic\Domain\Service\StatisticService;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;
use Scandinaver\User\Domain\Event\Notifications\UserVisitedNotification;

/**
 *
 */
class UserEventsSubscriber implements ShouldQueue
{

    public function __construct(
        private readonly StatisticService $statisticService,
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    public function handleUserVisit(UserVisitedNotification $event): void
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::USER_VISITED,
            $user
        ));
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            UserVisitedNotification::class,
            [UserEventsSubscriber::class, 'handleUserVisit']
        );
    }
}
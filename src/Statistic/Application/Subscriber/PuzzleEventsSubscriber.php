<?php

namespace Scandinaver\Statistic\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Scandinaver\Learning\Puzzle\Domain\Event\PuzzleCompletedNotification;
use Scandinaver\Statistic\Domain\DTO\StatisticItemDTO;
use Scandinaver\Statistic\Domain\Enum\StatisticType;
use Scandinaver\Statistic\Domain\Service\StatisticService;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;


/**
 * Class PuzzleEventsSubscriber
 *
 * @package Scandinaver\Statistic\Application\Subscriber
 */
class PuzzleEventsSubscriber implements ShouldQueue
{
    public function __construct(
        private readonly StatisticService $statisticService,
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }

    public function handlePuzzleCompleted(PuzzleCompletedNotification $event): void
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::PUZZLE_PASSED,
            $user,
            NULL,
            ['puzzle_id' => $event->getPuzzleId()]
        ));
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            PuzzleCompletedNotification::class,
            [PuzzleEventsSubscriber::class, 'handlePuzzleCompleted']
        );
    }
}
<?php

namespace Scandinaver\Statistic\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\AssetCreatedNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\AssetDeletedNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\CardAddedToAssetNotification;
use Scandinaver\Learning\Asset\Domain\Event\Notifications\CardRemovedFromAssetNotification;
use Scandinaver\Statistic\Domain\DTO\StatisticItemDTO;
use Scandinaver\Statistic\Domain\Enum\StatisticType;
use Scandinaver\Statistic\Domain\Service\StatisticService;
use Scandinaver\User\Domain\Contract\Repository\UserRepositoryInterface;

/**
 * Class AssetEventsSubscriber
 *
 * @package Scandinaver\Statistic\Application\Subscriber
 */
class AssetEventsSubscriber implements ShouldQueue
{

    public function __construct(
        private readonly StatisticService $statisticService,
        private readonly UserRepositoryInterface $userRepository
    )
    {
    }

    public function handleAssetCreated(AssetCreatedNotification $event)
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::ASSET_CREATED,
            $user,
            NULL,
            ['asset_id' => $event->getAssetId()]
        ));
    }

    public function handleAssetDeleted(AssetDeletedNotification $event)
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::ASSET_DELETED,
            $user,
            NULL,
            ['asset_id' => $event->getAssetId()]
        ));
    }

    public function handleCardAddedToAsset(CardAddedToAssetNotification $event)
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::CARD_ADDED,
            $user,
            NULL,
            ['asset_id' => $event->getAssetId(), 'card_id' => $event->getCardId()]
        ));
    }

    public function handleCardRemovedFromAsset(CardRemovedFromAssetNotification $event)
    {
        $user = $this->userRepository->find($event->getUserId());

        $this->statisticService->create(new StatisticItemDTO(
            StatisticType::CARD_REMOVED,
            $user,
            NULL,
            ['asset_id' => $event->getAssetId(), 'card_id' => $event->getCardId()]
        ));
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            AssetCreatedNotification::class,
            [AssetEventsSubscriber::class, 'handleAssetCreated']
        );

        $events->listen(
            AssetDeletedNotification::class,
            [AssetEventsSubscriber::class, 'handleAssetDeleted']
        );

        $events->listen(
            CardAddedToAssetNotification::class,
            [AssetEventsSubscriber::class, 'handleCardAddedToAsset']
        );

        $events->listen(
            CardRemovedFromAssetNotification::class,
            [AssetEventsSubscriber::class, 'handleCardRemovedFromAsset']
        );
    }
}
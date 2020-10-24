<?php


namespace Scandinaver\Learn\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Events\CardAddedToAsset;

class CardAddedToAssetListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(CardAddedToAsset $event)
    {
        $this->logger->info(
            'В словарь {assetname} добавлена карточка id:{cardId}',
            [
                'assetname' => $event->getAsset()->getTitle(),
                'cardId' => $event->getCard()->getId(),
            ]
        );
    }
}
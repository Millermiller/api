<?php


namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learning\Asset\Domain\Event\CardAddedToAsset;

/**
 * Class CardAddedToAssetListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class CardAddedToAssetListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  CardAddedToAsset  $event
     */
    public function handle(CardAddedToAsset $event)
    {
        $this->logger->info(
            'В словарь {assetname} добавлена карточка id:{cardId}',
            [
                'assetname' => $event->getAsset()->getTitle(),
                'cardId'    => $event->getCard()->getId(),
            ]
        );
    }
}
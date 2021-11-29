<?php


namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Psr\Log\LoggerInterface;
use Scandinaver\Learning\Asset\Domain\Event\CardRemovedFromAsset;

/**
 * Class CardRemovedFromAssetListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class CardRemovedFromAssetListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  CardRemovedFromAsset  $event
     */
    public function handle(CardRemovedFromAsset $event)
    {
        $this->logger->info(
            'Из словаря {assetname} удалена карточка id:{cardId}',
            [
                'assetname' => $event->getAsset()->getTitle(),
                'cardId'    => $event->getCard()->getId(),
            ]
        );
    }
}
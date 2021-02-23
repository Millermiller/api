<?php


namespace Scandinaver\Learn\Domain\Events\Listeners;

use Psr\Log\LoggerInterface;
use Scandinaver\Learn\Domain\Events\CardRemovedFromAsset;

/**
 * Class CardRemovedFromAssetListener
 *
 * @package Scandinaver\Learn\Domain\Events\Listeners
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
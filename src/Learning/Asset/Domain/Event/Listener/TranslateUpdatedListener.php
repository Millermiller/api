<?php


namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Scandinaver\Learning\Asset\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Event\TranslateUpdated;

/**
 * Class TranslateUpdatedListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class TranslateUpdatedListener
{

    private TranslateRepositoryInterface $translateRepository;

    public function __construct(TranslateRepositoryInterface $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    /**
     * @param  TranslateUpdated  $event
     */
    public function handle(TranslateUpdated $event)
    {
        $translate = $event->getTranslate();
        $value     = $event->getValue();

        $translate->setValue($value);

        $this->translateRepository->save($translate);
    }
}
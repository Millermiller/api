<?php


namespace Scandinaver\Learn\Domain\Event\Listener;

use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Event\TranslateUpdated;

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
        $word  = $event->getTranslate();
        $value = $event->getValue();

        $word->setValue($value);

        $this->translateRepository->save($word);
    }
}
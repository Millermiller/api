<?php


namespace Scandinaver\Learn\Domain\Events\Listeners;

use Scandinaver\Learn\Domain\Contract\Repository\TranslateRepositoryInterface;
use Scandinaver\Learn\Domain\Events\TranslateUpdated;

class TranslateUpdatedListener
{

    private TranslateRepositoryInterface $translateRepository;

    public function __construct(TranslateRepositoryInterface $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    public function handle(TranslateUpdated $event)
    {
        $word = $event->getTranslate();
        $value = $event->getValue();

        $word->setValue($value);

        $this->translateRepository->save($word);
    }
}
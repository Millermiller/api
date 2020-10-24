<?php


namespace Scandinaver\Learn\Domain\Events\Listeners;

use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Events\WordUpdated;

class WordUpdatedListener
{

    private WordRepositoryInterface $wordRepository;

    public function __construct(WordRepositoryInterface $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    public function handle(WordUpdated $event)
    {
        $word = $event->getWord();
        $value = $event->getValue();

        $word->setValue($value);

        $this->wordRepository->save($word);
    }
}
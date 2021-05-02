<?php


namespace Scandinaver\Learn\Domain\Event\Listener;

use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Event\WordUpdated;

/**
 * Class WordUpdatedListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class WordUpdatedListener
{

    private WordRepositoryInterface $wordRepository;

    public function __construct(WordRepositoryInterface $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    /**
     * @param  WordUpdated  $event
     */
    public function handle(WordUpdated $event)
    {
        $word  = $event->getWord();
        $value = $event->getValue();

        $word->setValue($value);

        $this->wordRepository->save($word);
    }
}
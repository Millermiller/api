<?php


namespace Scandinaver\Learning\Asset\Domain\Event\Listener;

use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Event\TermUpdated;

/**
 * Class TermUpdatedListener
 *
 * @package Scandinaver\Learn\Domain\Event\Listener
 */
class TermUpdatedListener
{

    private TermRepositoryInterface $termRepository;

    public function __construct(TermRepositoryInterface $termRepository)
    {
        $this->termRepository = $termRepository;
    }

    /**
     * @param  TermUpdated  $event
     */
    public function handle(TermUpdated $event)
    {
        $term  = $event->getTerm();
        $value = $event->getValue();

        $term->setValue($value);

        $this->termRepository->save($term);
    }
}
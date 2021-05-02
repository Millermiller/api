<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\WordNotFoundException;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Trait WordTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait WordTrait
{
    /**
     * @param  int  $id
     *
     * @return Word
     * @throws WordNotFoundException
     */
    private function getWord(int $id): Word
    {
        /** @var  WordRepositoryInterface $repository */
        $repository = Container::getInstance()->get(WordRepositoryInterface::class);

        /** @var Word $word */
        $word = $repository->find($id);

        if ($word === NULL) {
            throw new WordNotFoundException();
        }

        return $word;
    }
}
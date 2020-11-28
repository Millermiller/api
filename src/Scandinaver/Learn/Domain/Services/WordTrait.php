<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\WordRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\WordNotFoundException;
use Scandinaver\Learn\Domain\Model\Word;

/**
 * Trait WordTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait WordTrait
{
    private function getWord(int $id): Word
    {
        /** @var  WordRepositoryInterface $repository */
        $repository = Container::getInstance()->get(WordRepositoryInterface::class);

        /** @var Word $word */
        $word = $repository->find($id);

        if ($word === null) {
            throw new WordNotFoundException();
        }

        return $word;
    }
}
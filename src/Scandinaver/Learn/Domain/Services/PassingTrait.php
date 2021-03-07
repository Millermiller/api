<?php


namespace Scandinaver\Learn\Domain\Services;


use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\ResultRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\PassingNotFoundException;
use Scandinaver\Learn\Domain\Model\Result;

/**
 * Trait PassingTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait PassingTrait
{
    /**
     * @param  int  $id
     *
     * @return Result
     * @throws PassingNotFoundException
     */
    private function getPassing(int $id): Result
    {
        /** @var  ResultRepositoryInterface $repository */
        $repository = Container::getInstance()->get(ResultRepositoryInterface::class);

        /** @var Result $passing */
        $passing = $repository->find($id);

        if ($passing === NULL) {
            throw new PassingNotFoundException();
        }

        return $passing;
    }
}
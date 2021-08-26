<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learn\Domain\Entity\Passing;

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
     * @return Passing
     * @throws PassingNotFoundException
     */
    private function getPassing(int $id): Passing
    {
        $repository = Container::getInstance()->get(PassingRepositoryInterface::class);

        $passing = $repository->find($id);

        if ($passing === NULL) {
            throw new PassingNotFoundException();
        }

        return $passing;
    }
}
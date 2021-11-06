<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\PassingRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Exception\PassingNotFoundException;
use Scandinaver\Learning\Asset\Domain\Entity\Passing;

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
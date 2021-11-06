<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Entity\Term;
use Scandinaver\Learning\Asset\Domain\Exception\TermNotFoundException;

/**
 * Trait TermTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait TermTrait
{
    /**
     * @param  int  $id
     *
     * @return Term
     * @throws TermNotFoundException
     */
    private function getTerm(int $id): Term
    {
        $repository = Container::getInstance()->get(TermRepositoryInterface::class);

        $term = $repository->find($id);

        if ($term === NULL) {
            throw new TermNotFoundException();
        }

        return $term;
    }
}
<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Learn\Domain\Contract\Repository\TermRepositoryInterface;
use Scandinaver\Learn\Domain\Entity\Term;
use Scandinaver\Learn\Domain\Exception\TermNotFoundException;

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
        /** @var  TermRepositoryInterface $repository */
        $repository = Container::getInstance()->get(TermRepositoryInterface::class);

        /** @var Term $term */
        $term = $repository->find($id);

        if ($term === NULL) {
            throw new TermNotFoundException();
        }

        return $term;
    }
}
<?php


namespace Scandinaver\Learn\Domain\Service;

use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Exception\CardNotFoundException;
use Scandinaver\Learn\Domain\Entity\Card;

/**
 * Trait CardTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait CardTrait
{
    /**
     * @param  int  $id
     *
     * @return Card
     * @throws CardNotFoundException
     */
    private function getCard(int $id): Card
    {
        /** @var  CardRepositoryInterface $repository */
        $repository = app(CardRepositoryInterface::class);

        /** @var Card $card */
        $card = $repository->find($id);

        if ($card === NULL) {
            throw new CardNotFoundException();
        }

        return $card;
    }
}
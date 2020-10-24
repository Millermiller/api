<?php


namespace Scandinaver\Learn\Domain\Services;

use Scandinaver\Learn\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learn\Domain\Exceptions\CardNotFoundException;
use Scandinaver\Learn\Domain\Model\Card;

/**
 * Trait CardTrait
 *
 * @package Scandinaver\Learn\Domain\Services
 */
trait CardTrait
{
    private function getCard(int $id): Card
    {
        /** @var  CardRepositoryInterface $repository */
        $repository = app(CardRepositoryInterface::class);

        /** @var Card $card */
        $card = $repository->find($id);

        if ($card === null) {
            throw new CardNotFoundException();
        }

        return $card;
    }
}
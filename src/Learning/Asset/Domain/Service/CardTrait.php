<?php


namespace Scandinaver\Learning\Asset\Domain\Service;

use Scandinaver\Core\Infrastructure\Service\Container;
use Scandinaver\Learning\Asset\Domain\Contract\Repository\CardRepositoryInterface;
use Scandinaver\Learning\Asset\Domain\Exception\CardNotFoundException;
use Scandinaver\Learning\Asset\Domain\Entity\Card;

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
        $repository = Container::getInstance()->get(CardRepositoryInterface::class);

        $card = $repository->find($id);

        if ($card === NULL) {
            throw new CardNotFoundException();
        }

        return $card;
    }
}
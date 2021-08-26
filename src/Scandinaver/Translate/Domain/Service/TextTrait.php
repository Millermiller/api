<?php


namespace Scandinaver\Translate\Domain\Service;

use Scandinaver\Common\Infrastructure\Service\Container;
use Scandinaver\Translate\Domain\Contract\Repository\TextRepositoryInterface;
use Scandinaver\Translate\Domain\Exception\TextNotFoundException;
use Scandinaver\Translate\Domain\Entity\Text;

/**
 * Trait TextTrait
 *
 * @package Scandinaver\Translate\Domain
 */
trait TextTrait
{
    /**
     * @param  int  $id
     *
     * @return Text
     * @throws TextNotFoundException
     */
    private function getText(int $id): Text
    {
        $repository = Container::getInstance()->get(TextRepositoryInterface::class);

        $text = $repository->find($id);

        if ($text === null) {
            throw new TextNotFoundException();
        }

        return $text;
    }
}
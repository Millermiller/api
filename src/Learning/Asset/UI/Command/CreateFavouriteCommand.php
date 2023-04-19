<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\CreateFavouriteCommandHandler;

/**
 * Class CreateFavouriteCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(CreateFavouriteCommandHandler::class)]
class CreateFavouriteCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private int $card)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
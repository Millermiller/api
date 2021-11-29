<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Application\Handler\Command\CreateAssetCommandHandler;
use Scandinaver\Learning\Asset\Domain\DTO\AssetDTO;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(CreateAssetCommandHandler::class)]
class CreateAssetCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private array $data)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function buildDTO(): AssetDTO
    {
        return AssetDTO::fromArray($this->data);
    }
}
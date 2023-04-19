<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Application\Handler\Command\CreateAssetCommandHandler;
use Scandinaver\Learning\Asset\Domain\DTO\AssetDTO;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(CreateAssetCommandHandler::class)]
class CreateAssetCommand implements CommandInterface
{

    public function __construct(private readonly UserInterface $user, private readonly array $data)
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
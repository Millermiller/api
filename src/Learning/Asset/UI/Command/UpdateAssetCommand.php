<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UpdateAssetCommandHandler;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Command(UpdateAssetCommandHandler::class)]
class UpdateAssetCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private int $asset, private array $data)
    {
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->data['title'];
    }

    /**
     * @return int|mixed
     */
    public function getLevel()
    {
        return $this->data['level'] ? $this->data['level'] : 0;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
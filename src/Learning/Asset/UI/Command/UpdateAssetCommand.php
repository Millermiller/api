<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\UpdateAssetCommandHandler;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(UpdateAssetCommandHandler::class)]
class UpdateAssetCommand implements CommandInterface
{

    public function __construct(private UserInterface $user, private string $asset, private array $data)
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
     * @return mixed
     */
    public function getLevel(): mixed
    {
        return $this->data['level'] ? $this->data['level'] : 0;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getAsset(): string
    {
        return $this->asset;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
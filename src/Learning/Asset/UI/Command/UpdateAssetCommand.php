<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UpdateAssetCommandHandler
 */
class UpdateAssetCommand implements CommandInterface
{
    private UserInterface $user;

    private array $data;

    private int $asset;

    public function __construct(UserInterface $user, int $asset, array $data)
    {
        $this->user  = $user;
        $this->data  = $data;
        $this->asset = $asset;
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
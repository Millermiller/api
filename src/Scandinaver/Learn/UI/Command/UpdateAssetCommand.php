<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class CreateAssetCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\UpdateAssetHandler
 * @package Scandinaver\Learn\UI\Command
 */
class UpdateAssetCommand implements Command
{
    private User $user;

    private array $data;

    private int $asset;

    public function __construct(User $user, int $asset, array $data)
    {
        $this->user = $user;
        $this->data = $data;
        $this->asset = $asset;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        return $this->data['title'];
    }

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
}
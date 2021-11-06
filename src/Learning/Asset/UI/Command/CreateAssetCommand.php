<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Domain\DTO\AssetDTO;
use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class CreateAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\CreateAssetCommandHandler
 */
class CreateAssetCommand implements CommandInterface
{
    private UserInterface $user;

    private array $data;

    public function __construct(UserInterface $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
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
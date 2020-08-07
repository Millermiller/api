<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\Asset;
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
    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $data;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * CreateAssetCommand constructor.
     *
     * @param  User   $user
     * @param  Asset  $asset
     * @param  array  $data
     */
    public function __construct(User $user, Asset $asset, array $data)
    {
        $this->user = $user;
        $this->data = $data;
        $this->asset = $asset;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->data['title'];
    }

    public function getLevel()
    {
        return $this->data['level'] ? $this->data['level'] : 0;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
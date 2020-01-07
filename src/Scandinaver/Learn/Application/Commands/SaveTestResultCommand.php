<?php


namespace Scandinaver\Learn\Application\Commands;

use App\Entities\User;
use Scandinaver\Learn\Domain\Asset;
use Scandinaver\Shared\Command;

/**
 * Class SaveTestResultCommand
 * @package Scandinaver\Learn\Application\Commands
 */
class SaveTestResultCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * @var int
     */
    private $resultValue;

    /**
     * SaveTestResultCommand constructor.
     * @param User $user
     * @param Asset $asset
     * @param int $resultValue
     */
    public function __construct(User $user, Asset $asset, int $resultValue)
    {
        $this->user = $user;
        $this->asset = $asset;
        $this->resultValue = $resultValue;
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
     * @return int
     */
    public function getResultValue(): int
    {
        return $this->resultValue;
    }
}
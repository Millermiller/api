<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AddCardToAssetCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddCardToAssetHandler
 */
class AddCardToAssetCommand implements Command
{
    private User $user;

    private int $asset;

    private string $language;

    private int $card;

    public function __construct(
        User $user,
        string $language,
        int $card,
        int $asset
    ) {
        $this->user     = $user;
        $this->asset    = $asset;
        $this->language = $language;
        $this->card     = $card;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getAsset(): int
    {
        return $this->asset;
    }

    public function getCard(): int
    {
        return $this->card;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
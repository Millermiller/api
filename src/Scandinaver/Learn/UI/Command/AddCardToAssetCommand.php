<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Learn\Domain\Model\{Asset, Translate, Word};
use Scandinaver\Shared\Contract\Command;
use Scandinaver\User\Domain\Model\User;

/**
 * Class AddCardToAssetCommand
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddCardToAssetHandler
 * @package Scandinaver\Learn\UI\Command
 */
class AddCardToAssetCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Word
     */
    private $word;

    /**
     * @var Translate
     */
    private $translate;

    /**
     * @var Asset
     */
    private $asset;

    /**
     * CreateAssetCommand constructor.
     *
     * @param  User       $user
     * @param  Word       $word
     * @param  Translate  $translate
     * @param  Asset      $asset
     */
    public function __construct(
        User $user,
        Word $word,
        Translate $translate,
        Asset $asset
    ) {
        $this->user = $user;
        $this->word = $word;
        $this->translate = $translate;
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
     * @return Word
     */
    public function getWord(): Word
    {
        return $this->word;
    }

    /**
     * @return Translate
     */
    public function getTranslate(): Translate
    {
        return $this->translate;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }
}
<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class PersonalAssetsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\PersonalAssetsQueryHandler
 */
class PersonalAssetsQuery implements CommandInterface
{
    private UserInterface $user;

    private string $language;

    public function __construct(UserInterface $user, string $language)
    {
        $this->user     = $user;
        $this->language = $language;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
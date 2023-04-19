<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\PersonalAssetsQueryHandler;

/**
 * Class PersonalAssetsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Handler(PersonalAssetsQueryHandler::class)]
class PersonalAssetsQuery implements QueryInterface
{

    public function __construct(private UserInterface $user, private string $language)
    {
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
<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\AssetsQueryHandler;

/**
 * Class AssetsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(AssetsQueryHandler::class)]
class AssetsQuery implements QueryInterface
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
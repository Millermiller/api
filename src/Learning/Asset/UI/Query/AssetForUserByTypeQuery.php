<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Core\Domain\Contract\UserInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\AssetForUserByTypeQueryHandler;

/**
 * Class AssetByForUserByTypeQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(AssetForUserByTypeQueryHandler::class)]
class AssetForUserByTypeQuery implements QueryInterface
{

    public function __construct(private string $language, private UserInterface $user, private string $type)
    {
    }

    public function getType(): string
    {
        return $this->type;
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
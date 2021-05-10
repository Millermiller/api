<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Contract\UserInterface;
use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class AssetByForUserByTypeQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetForUserByTypeQueryHandler
 */
class AssetForUserByTypeQuery implements QueryInterface
{
    private string $type;

    private UserInterface $user;

    private string $language;

    public function __construct(string $language, UserInterface $user, string $type)
    {
        $this->user     = $user;
        $this->type     = $type;
        $this->language = $language;
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
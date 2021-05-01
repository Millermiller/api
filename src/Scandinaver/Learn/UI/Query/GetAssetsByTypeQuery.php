<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class GetAssetsByTypeQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetAssetsByTypeQueryHandler
 */
class GetAssetsByTypeQuery implements CommandInterface
{
    private string $languageId;

    private int $type;

    public function __construct(string $languageId, int $type)
    {
        $this->languageId = $languageId;
        $this->type       = $type;
    }

    public function getLanguage(): string
    {
        return $this->languageId;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
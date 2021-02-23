<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Shared\Contract\Query;

/**
 * Class GetAssetsByTypeQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetAssetsByTypeHandler
 */
class GetAssetsByTypeQuery implements Query
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
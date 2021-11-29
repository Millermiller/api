<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\GetAssetsByTypeQueryHandler;

/**
 * Class GetAssetsByTypeQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(GetAssetsByTypeQueryHandler::class)]
class GetAssetsByTypeQuery implements QueryInterface
{

    public function __construct(private string $languageId, private int $type)
    {
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
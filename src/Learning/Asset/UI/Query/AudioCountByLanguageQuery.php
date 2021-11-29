<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Query;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\AudioCountByLanguageQueryHandler;

/**
 * Class AudioCountByLanguageQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Query(AudioCountByLanguageQueryHandler::class)]
class AudioCountByLanguageQuery implements QueryInterface
{

    public function __construct(private string $language)
    {
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
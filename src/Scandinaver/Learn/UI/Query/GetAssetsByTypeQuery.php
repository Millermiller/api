<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class GetAssetsByTypeQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetAssetsByTypeHandler
 * @package Scandinaver\Learn\UI\Query
 */
class GetAssetsByTypeQuery implements Query
{
    private Language $language;

    private int $type;

    public function __construct(Language $language, int $type)
    {
        $this->language = $language;
        $this->type = $type;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }

    public function getType(): int
    {
        return $this->type;
    }
}
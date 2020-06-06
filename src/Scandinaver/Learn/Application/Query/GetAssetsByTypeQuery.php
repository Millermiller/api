<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class GetAssetsByTypeQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see \Scandinaver\Learn\Application\Handlers\GetAssetsByTypeHandler
 */
class GetAssetsByTypeQuery implements Query
{
    /**
     * @var Language
     */
    private $language;

    /**
     * @var int
     */
    private $type;

    /**
     * GetAssetsByTypeQuery constructor.
     *
     * @param Language $language
     * @param int      $type
     */
    public function __construct(Language $language, int $type)
    {
        $this->language = $language;
        $this->type = $type;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}
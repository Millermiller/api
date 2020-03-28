<?php


namespace Scandinaver\Learn\Application\Query;

use Scandinaver\Common\Domain\Language;
use Scandinaver\Shared\Contracts\Query;

/**
 * Class AssetsCountQuery
 *
 * @package Scandinaver\Learn\Application\Query
 * @see     \Scandinaver\Learn\Application\Handlers\AssetsCountHandler
 */
class AssetsCountQuery implements Query
{
    /**
     * @var Language
     */
    private $language;

    /**
     * WordsCountQuery constructor.
     *
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }
}
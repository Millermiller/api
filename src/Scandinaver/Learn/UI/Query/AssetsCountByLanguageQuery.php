<?php


namespace Scandinaver\Learn\UI\Query;

use Scandinaver\Common\Domain\Model\Language;
use Scandinaver\Shared\Contract\Query;

/**
 * Class AssetsCountByLanguageQuery
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\AssetsCountByLanguageHandler
 * @package Scandinaver\Learn\UI\Query
 */
class AssetsCountByLanguageQuery implements Query
{
    private Language $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): Language
    {
        return $this->language;
    }
}
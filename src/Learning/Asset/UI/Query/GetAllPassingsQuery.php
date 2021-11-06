<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetAllPassingsQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\GetAllPassingsQueryHandler
 */
class GetAllPassingsQuery implements QueryInterface
{
    private string $language;

    public function __construct(string $language)
    {
        $this->language = $language;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
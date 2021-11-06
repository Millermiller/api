<?php


namespace Scandinaver\Learning\Translate\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class GetSynonymsQuery
 *
 * @package Scandinaver\Translate\UI\Query
 *
 * @see     \Scandinaver\Translate\Application\Handler\Query\GetSynonymsQueryHandler
 */
class GetSynonymsQuery implements QueryInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
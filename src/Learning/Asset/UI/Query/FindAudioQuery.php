<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Shared\Contract\QueryInterface;

/**
 * Class FindAudioQuery
 *
 * @package Scandinaver\Learn\UI\Query
 *
 * @see     \Scandinaver\Learn\Application\Handler\Query\FindAudioQueryHandler
 */
class FindAudioQuery implements QueryInterface
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
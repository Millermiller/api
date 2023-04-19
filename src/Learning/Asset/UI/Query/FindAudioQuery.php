<?php


namespace Scandinaver\Learning\Asset\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Learning\Asset\Application\Handler\Query\FindAudioQueryHandler;

/**
 * Class FindAudioQuery
 *
 * @package Scandinaver\Learn\UI\Query
 */
#[Handler(FindAudioQueryHandler::class)]
class FindAudioQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
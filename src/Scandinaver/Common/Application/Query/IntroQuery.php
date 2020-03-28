<?php


namespace Scandinaver\Common\Application\Query;

use Scandinaver\Shared\Contracts\Query;

/**
 * Class IntroQuery
 *
 * @package Scandinaver\Common\Application\Query
 */
class IntroQuery implements Query
{
    /**
     * @var int
     */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
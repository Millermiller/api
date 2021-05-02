<?php


namespace Scandinaver\Settings\UI\Query;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class SettingQuery
 *
 * @package Scandinaver\Settings\UI\Query
 *
 * @see \Scandinaver\Settings\Application\Handler\Query\SettingQueryHandler
 */
class SettingQuery implements CommandInterface
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
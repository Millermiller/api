<?php


namespace Scandinaver\Settings\UI\Query;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\QueryInterface;
use Scandinaver\Settings\Application\Handler\Query\SettingQueryHandler;

/**
 * Class SettingQuery
 *
 * @package Scandinaver\Settings\UI\Query
 */
#[Handler(SettingQueryHandler::class)]
class SettingQuery implements QueryInterface
{

    public function __construct(private int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}
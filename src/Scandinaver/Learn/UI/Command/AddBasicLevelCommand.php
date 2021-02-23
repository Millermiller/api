<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class AddBasicLevelCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddBasicLevelHandler
 */
class AddBasicLevelCommand implements Command
{
    private int $type;

    private string $language;

    public function __construct(string $language, array $data)
    {
        $this->type     = $data['asset_id'];
        $this->language = $language;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}
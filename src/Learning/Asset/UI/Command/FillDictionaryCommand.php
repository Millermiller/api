<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;
use Scandinaver\Shared\DTO;

/**
 * Class FillDictionaryCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\FillDictionaryCommandHandler
 */
class FillDictionaryCommand implements CommandInterface
{
    private string $language;

    private int $termId;

    public function __construct(string $language, int $termId)
    {
        $this->language = $language;
        $this->termId     = $termId;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getTermId(): int
    {
        return $this->termId;
    }

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
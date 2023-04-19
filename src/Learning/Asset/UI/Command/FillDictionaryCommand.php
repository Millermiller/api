<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\FillDictionaryCommandHandler;

/**
 * Class FillDictionaryCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(FillDictionaryCommandHandler::class)]
class FillDictionaryCommand implements CommandInterface
{

    public function __construct(private string $language, private int $termId)
    {
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
<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\Command;

/**
 * Class FillDictionaryCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\FillDictionaryHandler
 */
class FillDictionaryCommand implements Command
{
    private string $language;

    private int $word;

    public function __construct(string $language, int $word)
    {
        $this->language = $language;
        $this->word     = $word;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getWord(): int
    {
        return $this->word;
    }
}
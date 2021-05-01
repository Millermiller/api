<?php


namespace Scandinaver\Learn\UI\Command;

use Scandinaver\Shared\Contract\CommandInterface;

/**
 * Class AddWordAndTranslateCommand
 *
 * @package Scandinaver\Learn\UI\Command
 *
 * @see     \Scandinaver\Learn\Application\Handler\Command\AddWordAndTranslateCommandHandler
 */
class AddWordAndTranslateCommand implements CommandInterface
{
    private string $word;

    private string $translate;

    private int $issentence;

    public function __construct(array $data)
    {
        $this->word       = $data['word'];
        $this->translate  = $data['translate'];
        $this->issentence = $data['issentence'];
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }

    public function getIssentence(): int
    {
        return $this->issentence;
    }
}
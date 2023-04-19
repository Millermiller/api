<?php


namespace Scandinaver\Learning\Asset\UI\Command;

use Scandinaver\Core\Domain\Attribute\Handler;
use Scandinaver\Core\Domain\Contract\CommandInterface;
use Scandinaver\Core\Domain\DTO;
use Scandinaver\Learning\Asset\Application\Handler\Command\AddTermAndTranslateCommandHandler;

/**
 * Class AddTermAndTranslateCommand
 *
 * @package Scandinaver\Learn\UI\Command
 */
#[Handler(AddTermAndTranslateCommandHandler::class)]
class AddTermAndTranslateCommand implements CommandInterface
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

    public function buildDTO(): DTO
    {
        // TODO: Implement buildDTO() method.
    }
}
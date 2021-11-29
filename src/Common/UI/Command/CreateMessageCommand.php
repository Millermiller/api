<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Application\Handler\Command\CreateMessageCommandHandler;
use Scandinaver\Common\Domain\DTO\FeedbackDTO;
use Scandinaver\Core\Domain\Attribute\Command;
use Scandinaver\Core\Domain\Contract\CommandInterface;


/**
 * Class CreateMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 */
#[Command(CreateMessageCommandHandler::class)]
class CreateMessageCommand implements CommandInterface
{

    public function __construct(private array $data)
    {
    }

    public function buildDTO(): FeedbackDTO
    {
        return FeedbackDTO::fromArray($this->data);
    }
}
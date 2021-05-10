<?php


namespace Scandinaver\Common\UI\Command;

use Scandinaver\Common\Domain\DTO\FeedbackDTO;
use Scandinaver\Shared\Contract\CommandInterface;


/**
 * Class CreateMessageCommand
 *
 * @package Scandinaver\Common\UI\Command
 *
 * @see CreateMessageCommandHandler
 */
class CreateMessageCommand implements CommandInterface
{

    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function buildDTO(): FeedbackDTO
    {
        return FeedbackDTO::fromArray($this->data);
    }
}
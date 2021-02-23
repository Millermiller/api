<?php


namespace Scandinaver\Common\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class MessageDTO
 *
 * @package Scandinaver\Common\Domain\Model
 */
class MessageDTO extends DTO
{

    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'        => $this->message->getId(),
            'name'      => $this->message->getName(),
            'message'   => $this->message->getMessage(),
            'createdAt' => $this->message->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Model\{Message, MessageDTO};

/**
 * Class MessageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class MessageService
{
    private MessageRepositoryInterface $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function all(): array
    {
        $result = [];
        /** @var Message[] $messages */
        $messages = $this->messageRepository->findAll();
        foreach ($messages as $message) {
            $result[] = $message->toDTO();
        }

        return $result;
    }

    public function one(int $id): MessageDTO
    {
        $message = $this->getMessage($id);

        return $message->toDTO();
    }

    public function delete(int $id): void
    {
        $message = $this->getMessage($id);
        $message->delete();
        $this->messageRepository->delete($message);
    }

    private function getMessage(int $id): Message {
        /** @var Message $message */
        $message = $this->messageRepository->find($id);
        if ($message === null ) {
            throw new MessageNotFoundException();
        }

        return $message;
    }
}
<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Exception\MessageNotFoundException;
use Scandinaver\Common\Domain\Model\{Message, MessageDTO};
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class MessageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class MessageService implements BaseServiceInterface
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

    /**
     * @param  int  $id
     *
     * @return MessageDTO
     * @throws MessageNotFoundException
     */
    public function one(int $id): MessageDTO
    {
        $message = $this->getMessage($id);

        return $message->toDTO();
    }

    /**
     * @param  int  $id
     *
     * @throws MessageNotFoundException
     */
    public function delete(int $id): void
    {
        $message = $this->getMessage($id);
        $message->delete();
        $this->messageRepository->delete($message);
    }

    /**
     * @param  int  $id
     *
     * @return Message
     * @throws MessageNotFoundException
     */
    private function getMessage(int $id): Message {
        /** @var Message $message */
        $message = $this->messageRepository->find($id);
        if ($message === null ) {
            throw new MessageNotFoundException();
        }

        return $message;
    }
}
<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;

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
        return $this->messageRepository->all();
    }
}
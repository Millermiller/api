<?php


namespace Scandinaver\Common\Domain\Services;

use Scandinaver\Common\Domain\Contracts\MessageRepositoryInterface;

/**
 * Class MessageService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class MessageService
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * MessageService constructor.
     *
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->messageRepository->all();
    }
}
<?php


namespace Scandinaver\Common\Domain\Services;

use Exception;
use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Message;

/**
 * Class FeedbackService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class FeedbackService
{
    private MessageRepositoryInterface $messageRepository;

    /**
     * FeedbackService constructor.
     *
     * @param  MessageRepositoryInterface  $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param  array  $request
     *
     * @return Message
     * @throws Exception
     */
    public function saveFeedback(array $request): Message
    {
        $message = new Message($request['name'], $request['message']);

        $this->messageRepository->save($message);

        //  event(new MessageEvent($message));

        return $message;
    }
}
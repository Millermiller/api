<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Model\Message;

/**
 * Class FeedbackService
 *
 * @package Scandinaver\Common\Domain\Service
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

    public function saveFeedback(array $request): Message
    {
        $message = new Message($request['name'], $request['message']);

        $this->messageRepository->save($message);

        //  event(new MessageEvent($message));

        return $message;
    }
}
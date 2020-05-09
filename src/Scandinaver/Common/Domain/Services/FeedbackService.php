<?php


namespace Scandinaver\Common\Domain\Services;

use Exception;
use Scandinaver\Common\Domain\Contracts\MessageRepositoryInterface;
use Scandinaver\Common\Domain\Message;

/**
 * Class FeedbackService
 *
 * @package Scandinaver\Common\Domain\Services
 */
class FeedbackService
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * FeedbackService constructor.
     *
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param array $request
     *
     * @return Message
     * @throws Exception
     */
    public function saveFeedback(array $request)
    {
        $message = new Message($request['name'], $request['message']);

        $this->messageRepository->save($message);

        //  event(new MessageEvent($message));

        return $message;
    }
}
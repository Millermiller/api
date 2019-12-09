<?php

namespace App\Services;

use App\Entities\Message;
use App\Repositories\Message\MessageRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FeedbackService
 * @package app\Services
 */
class FeedbackService
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * FeedbackService constructor.
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @param array $request
     * @return Message|Model
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
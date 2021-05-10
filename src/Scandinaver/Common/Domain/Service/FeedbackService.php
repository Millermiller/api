<?php


namespace Scandinaver\Common\Domain\Service;

use Scandinaver\Common\Domain\Contract\Repository\FeedbackRepositoryInterface;
use Scandinaver\Common\Domain\DTO\FeedbackDTO;
use Scandinaver\Common\Domain\Model\Feedback;

/**
 * Class FeedbackService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class FeedbackService
{
    private FeedbackRepositoryInterface $feedbackRepository;

    /**
     * FeedbackService constructor.
     *
     * @param  FeedbackRepositoryInterface  $messageRepository
     */
    public function __construct(FeedbackRepositoryInterface $messageRepository)
    {
        $this->feedbackRepository = $messageRepository;
    }

    public function create(FeedbackDTO $feedbackDTO): Feedback
    {
        $feedback = FeedbackFactory::fromDTO($feedbackDTO);

        $this->feedbackRepository->save($feedback);

        return $feedback;
    }
}
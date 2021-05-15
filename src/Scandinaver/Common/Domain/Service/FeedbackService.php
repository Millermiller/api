<?php


namespace Scandinaver\Common\Domain\Service;

use Exception;
use Scandinaver\Common\Domain\Contract\Repository\FeedbackRepositoryInterface;
use Scandinaver\Common\Domain\DTO\FeedbackDTO;
use Scandinaver\Common\Domain\Model\Feedback;
use Scandinaver\Shared\Contract\BaseServiceInterface;

/**
 * Class FeedbackService
 *
 * @package Scandinaver\Common\Domain\Service
 */
class FeedbackService implements BaseServiceInterface
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


    public function all(): array
    {
        return $this->feedbackRepository->findAll();
    }

    /**
     * @param  int  $id
     *
     * @return Feedback
     * @throws Exception
     */
    public function one(int $id): Feedback
    {
        return $this->getFeedback($id);
    }

    public function create(FeedbackDTO $feedbackDTO): Feedback
    {
        $feedback = FeedbackFactory::fromDTO($feedbackDTO);

        $this->feedbackRepository->save($feedback);

        return $feedback;
    }

    /**
     * @param  int  $id
     *
     * @return Feedback
     * @throws Exception
     */
    private function getFeedback(int $id): Feedback
    {
        /** @var Feedback $feedback */
        $feedback = $this->feedbackRepository->find($id);
        if ($feedback === NULL) {
            throw new \Exception('Feedback not found');
        }

        return $feedback;
    }
}
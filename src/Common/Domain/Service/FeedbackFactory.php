<?php


namespace Scandinaver\Common\Domain\Service;


use Scandinaver\Common\Domain\DTO\FeedbackDTO;
use Scandinaver\Common\Domain\Entity\Feedback;

/**
 * Class FeedbackFactory
 *
 * @package Scandinaver\Common\Domain\Service
 */
class FeedbackFactory
{

    public static function fromDTO(FeedbackDTO $feedbackDTO): Feedback
    {
        return new Feedback(
            $feedbackDTO->getName(),
            $feedbackDTO->getMessage()
        );
    }
}
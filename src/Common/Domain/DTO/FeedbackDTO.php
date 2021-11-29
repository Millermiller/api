<?php


namespace Scandinaver\Common\Domain\DTO;


use Scandinaver\Core\Domain\DTO;

/**
 * Class FeedbackDTO
 *
 * @package Scandinaver\Common\Domain\DTO
 */
class FeedbackDTO extends DTO
{
    private string $name;

    private string $message;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public static function fromArray(array $data): FeedbackDTO
    {
        $feedbackDTO = new self();

        $feedbackDTO->setName($data['name']);
        $feedbackDTO->setMessage($data['message']);

        return $feedbackDTO;
    }
}
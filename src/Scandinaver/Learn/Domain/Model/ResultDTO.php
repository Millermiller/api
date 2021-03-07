<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class ResultDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class ResultDTO extends DTO
{
    private Result $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->result->getId(),
            'asset' => $this->result->getAsset()->toDTO(),
            'user' => $this->result->getUser()->toDTO(),
            'completed' => $this->result->isCompleted(),
            'percent' => $this->result->getPercent(),
            'time' => $this->result->getTime(),
            'errors' => $this->result->getErrors()
        ];
    }
}
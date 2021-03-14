<?php


namespace Scandinaver\Learn\Domain\Model;


use Scandinaver\Shared\DTO;

/**
 * Class PassingDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class PassingDTO extends DTO
{
    private Passing $passing;

    public function __construct(Passing $passing)
    {
        $this->passing = $passing;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->passing->getId(),
            'asset' => $this->passing->getAsset()->toDTO(),
            'user' => $this->passing->getUser()->toDTO(),
            'completed' => $this->passing->isCompleted(),
            'percent' => $this->passing->getPercent(),
            'time' => $this->passing->getTime(),
            'errors' => $this->passing->getErrors(),
            'created' => $this->passing->getCreatedAt()->format('Y.m.d H:i:s')
        ];
    }
}
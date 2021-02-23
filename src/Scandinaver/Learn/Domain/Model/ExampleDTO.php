<?php


namespace Scandinaver\Learn\Domain\Model;

use Scandinaver\Shared\DTO;

/**
 * Class ExampleDTO
 *
 * @package Scandinaver\Learn\Domain\Model
 */
class ExampleDTO extends DTO
{
    private Example $example;

    public function __construct(Example $example)
    {
        $this->example = $example;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'      => $this->example->getId(),
            'card_id' => $this->example->getCard()->getId(),
            'text'    => $this->example->getText(),
            'value'   => $this->example->getValue(),
        ];
    }
}
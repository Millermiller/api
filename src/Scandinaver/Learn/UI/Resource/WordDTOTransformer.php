<?php


namespace Scandinaver\Learn\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\DTO\WordDTO;

/**
 * Class CardTransformer
 *
 * @package Scandinaver\Learn\UI\Resource
 */
class WordDTOTransformer extends TransformerAbstract
{
    public function transform(WordDTO $wordDTO): array
    {
        return [
            'id'    => $wordDTO->getId(),
            'value' => $wordDTO->getValue(),
        ];
    }
}
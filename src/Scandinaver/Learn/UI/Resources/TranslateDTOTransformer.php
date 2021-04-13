<?php


namespace Scandinaver\Learn\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Learn\Domain\DTO\TranslateDTO;

/**
 * Class TranslateTransformer
 *
 * @package Scandinaver\Learn\UI\Resources
 */
class TranslateDTOTransformer extends TransformerAbstract
{
    public function transform(TranslateDTO $translateDTO): array
    {
        return [
            'id'    => $translateDTO->getId(),
            'value' => $translateDTO->getValue(),
        ];
    }
}
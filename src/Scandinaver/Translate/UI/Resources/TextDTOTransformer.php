<?php


namespace Scandinaver\Translate\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Translate\Domain\DTO\TextDTO;

/**
 * Class TextTransformer
 *
 * @package Scandinaver\Translate\UI\Resources
 */
class TextDTOTransformer extends TransformerAbstract
{
    public function transform(TextDTO $textDTO): array
    {
        return [
            'id'          => $textDTO->getId(),
            'language'    => $textDTO->getLanguage(),
            'level'       => $textDTO->getLevel(),
            'description' => $textDTO->getDescription(),
            'text'        => $textDTO->getText(),
            'image'       => $textDTO->getImage(),
            // 'count'       => $textDTO->getWords()->count(),
            // 'extra'       => $textDTO->getExtra()->toArray(),
        ];
    }
}
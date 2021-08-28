<?php


namespace Scandinaver\Common\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Entity\Language;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class LanguageTransformer extends TransformerAbstract
{

    public function transform(Language $languageDTO): array
    {
        return [
            'id'          => $languageDTO->getId(),
            'title'       => $languageDTO->getTitle(),
            'description' => $languageDTO->getDescription(),
            'letter'      => $languageDTO->getLetter(),
            'flag'        => asset($languageDTO->getFlag()),
            'image'       => asset($languageDTO->getImage()),
        ];
    }
}
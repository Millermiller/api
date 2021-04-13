<?php


namespace Scandinaver\Common\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\DTO\LanguageDTO;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resources
 */
class LanguageDTOTransformer extends TransformerAbstract
{
    public function transform(LanguageDTO $languageDTO): array
    {
        return [
            'id'     => $languageDTO->getId(),
            'title'  => $languageDTO->getTitle(),
            'label'  => $languageDTO->getLabel(),
            'letter' => $languageDTO->getLetter(),
            'flag'   => $languageDTO->getFlag(),
        ];
    }
}
<?php


namespace Scandinaver\Common\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\DTO\LanguageDTO;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resource
 */
class LanguageDTOTransformer extends TransformerAbstract
{
    public function transform(LanguageDTO $languageDTO): array
    {
        return [
            'id'     => $languageDTO->getId(),
            'title'  => $languageDTO->getTitle(),
            'letter' => $languageDTO->getLetter(),
            'flag'   => $languageDTO->getFlag(),
        ];
    }
}
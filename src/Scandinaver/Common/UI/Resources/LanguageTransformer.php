<?php


namespace Scandinaver\Common\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Common\Domain\Model\Language;

/**
 * Class IntroDTOTransformer
 *
 * @package Scandinaver\Common\UI\Resources
 */
class LanguageTransformer extends TransformerAbstract
{
    public function transform(Language $languageDTO): array
    {
        return [
            'id'     => $languageDTO->getId(),
            'title'  => $languageDTO->getTitle(),
            'label'  => $languageDTO->getLabel(),
            'letter' => $languageDTO->getLabel(),
            'flag'   => $languageDTO->getFlag(),
        ];
    }
}
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
            'id'     => $languageDTO->getId(),
            'title'  => $languageDTO->getTitle(),
            'letter' => $languageDTO->getLetter(),
            'flag'   => asset($languageDTO->getFlag())
        ];
    }
}
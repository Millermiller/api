<?php


namespace Scandinaver\Translate\UI\Resource;

use League\Fractal\TransformerAbstract;
use Scandinaver\Translate\Domain\Model\Text;

/**
 * Class TextTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TextTransformer extends TransformerAbstract
{
    public function transform(Text $text): array
    {
        return [
            'id'          => $text->getId(),
            'language'    => $text->getLanguage(),
            'level'       => $text->getLevel(),
            'description' => $text->getDescription(),
            'text'        => $text->getText(),
            'image'       => $text->getImage(),
            'count'       => $text->getWords()->count(),
            'extra'       => $text->getExtra()->toArray(),
        ];
    }
}
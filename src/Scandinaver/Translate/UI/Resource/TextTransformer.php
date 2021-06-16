<?php


namespace Scandinaver\Translate\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Translate\Domain\Entity\Text;

/**
 * Class TextTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TextTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'language',
        'extra',
        'image',
    ];

    public function transform(Text $text): array
    {
        return [
            'id'          => $text->getId(),
            'title'       => $text->getTitle(),
            'level'       => $text->getLevel(),
            'description' => $text->getDescription(),
            'text'        => $text->getText(),
            'count'       => $text->getWords()->count(),
            'extra'       => $text->getExtra()->toArray(),
            'sentences'   => $text->getSentences(),
            'dictionary'  => $text->getDictionary(),
            'translate'   => $text->getTranslate(),
            'published'   => $text->isPublished()
        ];
    }

    public function includeLanguage(Text $text): Item
    {
        $language = $text->getLanguage();

        return $this->item($language, new LanguageTransformer());
    }

    public function includeExtra(Text $text): Collection
    {
        $extras = $text->getExtra();

        return $this->collection($extras, new TextExtraTransformer());
    }

    public function includeImage(Text $text): Primitive
    {
        $image = $text->getImage();
        if ($image === NULL) {
            return $this->primitive(NULL);
        }

        return $this->primitive(asset('/uploads/t/' . $image));
    }
}
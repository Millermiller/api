<?php


namespace Scandinaver\Learning\Translate\UI\Resource;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;
use Scandinaver\Common\UI\Resource\LanguageTransformer;
use Scandinaver\Learning\Translate\Domain\Entity\Text;

/**
 * Class TextTransformer
 *
 * @package Scandinaver\Translate\UI\Resource
 */
class TextTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'language',
        'tooltips',
        'image',
        'dictionary',
        'text',
        'translate'
    ];

    public function transform(Text $text): array
    {
        return [
            'id'          => $text->getId(),
            'title'       => $text->getTitle(),
            'level'       => $text->getLevel(),
            'description' => $text->getDescription(),
            'count'       => $text->getTranslates()->count(),
            'published'   => $text->isPublished(),
            'available'   => TRUE,
            'active'      => TRUE
        ];
    }

    public function includeText(Text $text): Primitive
    {
        $content = $text->getText();

        return $this->primitive($content);
    }

    public function includeTranslate(Text $text): Primitive
    {
        $content = $text->getTranslate();

        return $this->primitive($content);
    }

    public function includeLanguage(Text $text): Item
    {
        $language = $text->getLanguage();

        return $this->item($language, new LanguageTransformer());
    }

    public function includeTooltips(Text $text): Collection
    {
        $tooltips = $text->getTooltips();

        return $this->collection($tooltips, new TooltipTransformer());
    }

    public function includeDictionary(Text $text): Collection
    {
        $dictionary = $text->getDictionary();

        return $this->collection($dictionary, new DictionaryItemTransformer());
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
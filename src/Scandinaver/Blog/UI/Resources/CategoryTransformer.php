<?php


namespace Scandinaver\Blog\UI\Resources;

use League\Fractal\TransformerAbstract;
use Scandinaver\Blog\Domain\Model\Category;

/**
 * Class CategoryTransformer
 *
 * @package Scandinaver\Blog\UI\Resource
 */
class CategoryTransformer extends TransformerAbstract
{

    public function transform(Category $category): array
    {
        return [
            'id'    => $category->getId(),
            'title' => $category->getTitle(),
        ];
    }
}
<?php


namespace Scandinaver\Blog\UI\Resources;

use JetBrains\PhpStorm\ArrayShape;
use League\Fractal\TransformerAbstract;
use Scandinaver\Blog\Domain\Entity\Category;

/**
 * Class CategoryTransformer
 *
 * @package Scandinaver\Blog\UI\Resource
 */
class CategoryTransformer extends TransformerAbstract
{

    #[ArrayShape(['id' => "int", 'title' => "string"])]
    public function transform(Category $category): array
    {
        return [
            'id'    => $category->getId(),
            'title' => $category->getTitle(),
        ];
    }
}
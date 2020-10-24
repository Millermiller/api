<?php


namespace Scandinaver\Blog\Domain\Events;


use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Shared\DomainEvent;

/**
 * Class CategoryNameUpdated
 *
 * @package Scandinaver\Blog\Domain\Events
 */
class CategoryNameUpdated implements DomainEvent
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }
}
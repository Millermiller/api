<?php


namespace Scandinaver\Blog\Domain\Event;

use Scandinaver\Blog\Domain\Model\Category;
use Scandinaver\Shared\DomainEvent;

/**
 * Class CategoryNameUpdated
 *
 * @package Scandinaver\Blog\Domain\Event
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